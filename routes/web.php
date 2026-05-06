<?php

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\ValidateCode;
use App\Livewire\Auth\VerifyEmail;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Caregiver\Dashboard as CaregiverDashboard;
use App\Livewire\Dashboard;
use App\Mail\CaregiverRequestCodeMail;
use App\Livewire\Profile\Dashboard as ProfileDashboard;
use App\Models\CaregiverRequestCode;
use App\Models\CaregiverRequest;
use App\Models\User;
use App\Support\RoleNames;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use App\Livewire\Doctors\Dashboard as DoctorDashboard;
use App\Livewire\Pharmaceutical\Dashboard as PharmaceuticalDashboard;


Route::redirect('/', '/login');

Route::middleware('guest:web')->group(function () {
	Route::get('/login', Login::class)->name('login');
	Route::get('/register', Register::class)->name('register');
	Route::get('/password/forgot', ForgotPassword::class)->name('password.request');
	Route::get('/password/code', ValidateCode::class)->name('password.code');
	Route::get('/password/reset', ResetPassword::class)->name('password.reset');
});

Route::middleware('auth:web')->group(function () {
	Route::get('/email/verify', VerifyEmail::class)->name('verification.notice');

	Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
		$request->fulfill();

		return redirect()->route('dashboard');
	})->middleware('signed')->name('verification.verify');

	Route::post('/logout', function (Request $request) {
		Auth::guard('web')->logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return redirect()->route('login');
	})->name('logout');
});

Route::middleware(['auth:web', 'verified'])->group(function () {
	Route::get('/dashboard', function () {
		/** @var \App\Models\User|null $user */
		$user = Auth::user();
		if (! $user) {
			return redirect()->route('login');
		}
		$role = $user->getRoleNames()->first();

		return match ($role) {
			RoleNames::ADMIN => redirect()->route('admin.dashboard'),
			RoleNames::DOCTOR => redirect()->route('doctor.dashboard'),
			RoleNames::PHARMACIST => redirect()->route('pharmaceutical.dashboard'),
			RoleNames::CAREGIVER => redirect()->route('caregiver.dashboard'),
			default => redirect()->route('patient.dashboard'),
		};
	})->name('dashboard');
	Route::get('/patient', Dashboard::class)->middleware('role:'.RoleNames::PATIENT.',web')->name('patient.dashboard');
	Route::get('/caregiver', CaregiverDashboard::class)->middleware('role:'.RoleNames::CAREGIVER.',web')->name('caregiver.dashboard');
	Route::get('/doctor', DoctorDashboard::class)->middleware('role:'.RoleNames::DOCTOR.',web')->name('doctor.dashboard');
	Route::get('/pharmaceutical', PharmaceuticalDashboard::class)->middleware('role:'.RoleNames::PHARMACIST.',web')->name('pharmaceutical.dashboard');
	Route::get('/admin', AdminDashboard::class)->middleware('role:'.RoleNames::ADMIN.',web')->name('admin.dashboard');
	Route::get('/profile', ProfileDashboard::class)->name('profile.dashboard');

	// Profile sub-pages
	Route::view('/profile/information', 'profile.information-account')->name('profile.information');
	Route::view('/profile/security', 'profile.security-account')->name('profile.security');
	// Professional data page
	Route::view('/profile/professional-data', 'profile.professional-data')->name('profile.professional-data');
	// View doctors page
	Route::view('/profile/view-doctors', 'profile.view-doctors')->name('profile.view-doctors');
	// View patients page
	Route::view('/profile/view-patients', 'profile.view-patients')->name('profile.view-patients');
	// View pharmacy page
	Route::view('/profile/view-pharmacy', 'profile.view-pharmacy')->name('profile.view-pharmacy');
	Route::view('/profile/be-patient', 'profile.be-patient')
		->middleware('role:'.RoleNames::CAREGIVER.',web')
		->name('profile.be-patient');
	Route::post('/profile/be-patient', function (Request $request) {
		$validator = Validator::make($request->all(), [
			'password' => ['required', 'string'],
		], [
			'password.required' => 'La contraseña es obligatoria.',
			'password.string' => 'La contraseña ingresada no es válida.',
		]);

		$user = $request->user();
		$password = (string) $request->input('password');

		$validator->after(function ($validator) use ($user, $password) {
			if (! $user || ! Hash::check($password, $user->password)) {
				$validator->errors()->add('password', 'La contraseña ingresada no coincide con la de tu cuenta.');
			}
		});

		if ($validator->fails()) {
			return back()->withErrors($validator)->with('open_be_patient_modal', true);
		}

		if (! $user) {
			abort(403);
		}

		$user->syncRoles([RoleNames::PATIENT]);

		return redirect()->route('patient.dashboard')->with('status', 'Ahora eres paciente nuevamente.');
	})->middleware('role:'.RoleNames::CAREGIVER.',web')->name('profile.be-patient.confirm');
	Route::view('/profile/be-caregiver', 'profile.be-caregiver')
		->middleware('role:'.RoleNames::PATIENT.',web')
		->name('profile.be-caregiver');
	Route::post('/profile/be-caregiver', function (Request $request) {
		$validator = Validator::make($request->all(), [
			'patient_email' => ['required', 'email'],
		]);

		$patient = null;
		$validator->after(function ($validator) use ($request, &$patient) {
			$email = strtolower(trim((string) $request->input('patient_email')));
			$patient = User::query()->where('email', $email)->first();
			if (! $patient || ! $patient->hasRole(RoleNames::PATIENT)) {
				$validator->errors()->add('patient_email', 'Correo de paciente no encontrado');
				return;
			}

			if ($request->user() && $patient->id === $request->user()->id) {
				$validator->errors()->add('patient_email', 'No puedes enviarte una solicitud a ti mismo.');
			}
		});

		$validator->validate();
		if (! $patient) {
			return back()->withErrors([
				'patient_email' => 'Correo de paciente no encontrado',
			]);
		}
		/** @var \App\Models\User $patient */

		/** @var \App\Models\User $caregiver */
		$caregiver = $request->user();
		$code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

		CaregiverRequestCode::updateOrCreate(
			[
				'caregiver_id' => $caregiver->id,
				'patient_id' => $patient->id,
			],
			[
				'email' => $patient->email,
				'code_hash' => Hash::make($code),
				'expires_at' => now()->addMinutes(30),
				'last_sent_at' => now(),
			]
		);

		Mail::to($patient->email)->send(new CaregiverRequestCodeMail($code));

		session([
			'caregiver_request_resend_available_at' => now()->addSeconds(30)->timestamp,
			'caregiver_request_patient_id' => $patient->id,
			'caregiver_request_patient_email' => $patient->email,
		]);

		return back()
			->with('status', 'Se envió el codigo al correo del paciente.')
			->with('open_caregiver_code_modal', true);
	})->middleware('role:'.RoleNames::PATIENT.',web')->name('profile.be-caregiver.request');

Route::post('/profile/be-caregiver/verify', function (Request $request) {
	$validator = Validator::make($request->all(), [
		'code' => ['required', 'string', 'size:6'],
	]);

	$validator->validate();

	$caregiver = $request->user();
	$patientId = (int) session('caregiver_request_patient_id', 0);

	if (! $patientId) {
		return back()->withErrors(['code' => 'No hay una solicitud pendiente.'])->with('open_caregiver_code_modal', true);
	}

	$record = CaregiverRequestCode::query()
		->where('caregiver_id', $caregiver->id)
		->where('patient_id', $patientId)
		->first();

	if (! $record || $record->expires_at->isPast()) {
		return back()->withErrors(['code' => 'Código no encontrado o expirado.'])->with('open_caregiver_code_modal', true);
	}

	if (! Hash::check($request->input('code'), $record->code_hash)) {
		return back()->withErrors(['code' => 'Código inválido.'])->with('open_caregiver_code_modal', true);
	}

	// Create or get the caregiver request and mark it as accepted because the patient confirmed
	$requestRecord = CaregiverRequest::firstOrCreate([
		'caregiver_id' => $caregiver->id,
		'patient_id' => $patientId,
	], ['status' => CaregiverRequest::STATUS_PENDING]);

	$requestRecord->status = CaregiverRequest::STATUS_ACCEPTED;
	$requestRecord->save();

	// remove code record
	$record->delete();

	// get patient email for friendly message
	$patientEmail = session('caregiver_request_patient_email') ?? optional(User::find($patientId))->email ?? 'el paciente';

	// Assign caregiver role to the current user
	$caregiver->syncRoles([RoleNames::CAREGIVER]);

	// clear session helper values
	session()->forget(['caregiver_request_resend_available_at', 'caregiver_request_patient_id', 'caregiver_request_patient_email', 'open_caregiver_code_modal']);

	return redirect()->route('caregiver.dashboard')->with('status', "Te has vuelto cuidador de {$patientEmail} exitosamente");
})->middleware('role:'.RoleNames::PATIENT.',web')->name('profile.be-caregiver.verify');
	Route::post('/profile/security/password', function (Request $request) {
		$validator = Validator::make($request->all(), [
			'new_password' => ['required', 'string', 'min:8'],
			'new_password_confirmation' => ['required', 'string'],
			'security_answer' => ['required', 'string'],
		]);

		$user = $request->user();
		$newPassword = (string) $request->input('new_password');
		$newPasswordConfirmation = (string) $request->input('new_password_confirmation');
		$securityAnswer = trim((string) $request->input('security_answer'));

		$validator->after(function ($validator) use ($user, $newPassword, $newPasswordConfirmation, $securityAnswer) {
			if ($newPassword !== $newPasswordConfirmation) {
				$validator->errors()->add('new_password_confirmation', 'Las contraseñas no coinciden.');
			}

			if (! $user || blank($user->security_question)) {
				$validator->errors()->add('security_answer', 'No tienes una pregunta de seguridad configurada en tu cuenta.');
				return;
			}

			if (! Hash::check($securityAnswer, (string) $user->security_answer)) {
				$validator->errors()->add('security_answer', 'La respuesta de seguridad no es válida.');
			}
		});

		$validator->validate();

		if (! $user) {
			abort(403);
		}

		$user->forceFill([
			'password' => $newPassword,
		])->save();

		return back()->with('status', 'Tu contraseña ha sido actualizada correctamente.');
	})->name('profile.security.password');
	Route::post('/profile/security/delete', function (Request $request) {
		$validator = Validator::make($request->all(), [
			'delete_password' => ['required', 'string'],
			'delete_password_confirmation' => ['required', 'string'],
		]);

		$user = $request->user();
		$password = (string) $request->input('delete_password');
		$passwordConfirmation = (string) $request->input('delete_password_confirmation');

		$validator->after(function ($validator) use ($user, $password, $passwordConfirmation) {
			if ($password !== $passwordConfirmation) {
				$validator->errors()->add('delete_password_confirmation', 'Las contraseñas no coinciden.');
			}

			if (! $user || ! Hash::check($password, $user->password)) {
				$validator->errors()->add('delete_password', 'La contraseña ingresada no coincide con la de tu cuenta.');
			}
		});

		$validator->validate();

		if (! $user) {
			abort(403);
		}

		Auth::guard('web')->logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();

		$user->delete();

		return redirect()->route('login')->with('status', 'Tu cuenta ha sido eliminada correctamente.');
	})->name('profile.security.destroy');

	// Verify current password via AJAX before allowing security question change
	Route::post('/profile/security/verify-password', function (Request $request) {
		$validator = Validator::make($request->all(), [
			'current_password' => ['required', 'string'],
			'current_password_confirmation' => ['required', 'string'],
		]);

		$user = $request->user();
		$password = (string) $request->input('current_password');
		$passwordConfirmation = (string) $request->input('current_password_confirmation');

		$validator->after(function ($validator) use ($user, $password, $passwordConfirmation) {
			if ($password !== $passwordConfirmation) {
				$validator->errors()->add('current_password_confirmation', 'Las contraseñas no coinciden.');
			}

			if (! $user || ! Hash::check($password, $user->password)) {
				$validator->errors()->add('current_password', 'La contraseña ingresada no coincide con la de tu cuenta.');
			}
		});

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 422);
		}

		return response()->json(['success' => true]);
	})->name('profile.security.verify-password');

	// Update security question and answer
	Route::post('/profile/security/question', function (Request $request) {
		$validator = Validator::make($request->all(), [
			'security_question' => ['required', 'string'],
			'security_answer' => ['required', 'string'],
		]);

		$user = $request->user();
		$question = (string) $request->input('security_question');
		$answer = (string) $request->input('security_answer');

		$validator->validate();

		if (! $user) {
			abort(403);
		}

		$user->forceFill([
			'security_question' => $question,
			'security_answer' => bcrypt($answer),
		])->save();

		return back()->with('status', 'La pregunta de seguridad se actualizó correctamente.');
	})->name('profile.security.question');

});
