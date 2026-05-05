<?php

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\ValidateCode;
use App\Livewire\Auth\VerifyEmail;
use App\Livewire\Dashboard;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
});
