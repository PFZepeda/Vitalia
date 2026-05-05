<?php

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\ValidateCode;
use App\Livewire\Auth\VerifyEmail;
use App\Livewire\Dashboard;
use App\Livewire\Profile\Dashboard as ProfileDashboard;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use App\Livewire\Doctors\Dashboard as DoctorDashboard;


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
	Route::get('/dashboard', Dashboard::class)->name('dashboard');
	Route::get('/profile', ProfileDashboard::class)->name('profile.dashboard');

	// Profile sub-pages
	Route::view('/profile/information', 'profile.information-account')->name('profile.information');
	Route::view('/profile/security', 'profile.security-account')->name('profile.security');
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
			'security_answer_confirmation' => ['required', 'string'],
		]);

		$user = $request->user();
		$answer = (string) $request->input('security_answer');
		$answerConfirmation = (string) $request->input('security_answer_confirmation');

		$validator->after(function ($validator) use ($answer, $answerConfirmation) {
			if ($answer !== $answerConfirmation) {
				$validator->errors()->add('security_answer_confirmation', 'Las respuestas no coinciden.');
			}
		});

		$validator->validate();

		if (! $user) {
			abort(403);
		}

		$user->forceFill([
			'security_question' => (string) $request->input('security_question'),
			'security_answer' => bcrypt($answer),
		])->save();

		return back()->with('status', 'La pregunta de seguridad se actualizó correctamente.');
	})->name('profile.security.question');

	Route::middleware(['auth:web', 'verified'])->group(function () {
		Route::get('/doctor', DoctorDashboard::class)->name('doctor.dashboard');
	});
});
