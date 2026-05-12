<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]

class VerifyEmail extends Component
{
    public ?string $statusMessage = null;
    public ?string $errorMessage = null;

    public function mount()
    {
        if (Auth::user()?->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        return null;
    }

    public function getCooldownRemainingProperty(): int
    {
        $timestamp = session('verification_resend_available_at');
        if (! $timestamp) {
            return 0;
        }

        $remaining = (int) $timestamp - now()->timestamp;

        return $remaining > 0 ? $remaining : 0;
    }

    public function resend()
    {
        $this->statusMessage = null;
        $this->errorMessage = null;

        if ($this->cooldownRemaining > 0) {
            return null;
        }

        $user = Auth::user();
        if (! $user || $user->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        try {
            $user->sendEmailVerificationNotification();
            session(['verification_resend_available_at' => now()->addSeconds(30)->timestamp]);
            $this->statusMessage = 'Se envio el enlace de verificacion.';
        } catch (\Throwable $exception) {
            $this->errorMessage = 'No se pudo enviar el correo. Intentalo mas tarde.';
        }

        return null;
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.verify-email');
    }
}
