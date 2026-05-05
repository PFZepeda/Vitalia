<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ResetPassword extends Component
{
    public string $password = '';
    public string $password_confirmation = '';
    public bool $passwordVisible = false;
    public bool $confirmPasswordVisible = false;

    public function mount()
    {
        if (! $this->hasValidSession()) {
            return redirect()->route('password.request');
        }

        return null;
    }

    public function togglePasswordVisibility(): void
    {
        $this->passwordVisible = ! $this->passwordVisible;
    }

    public function toggleConfirmPasswordVisibility(): void
    {
        $this->confirmPasswordVisible = ! $this->confirmPasswordVisible;
    }

    public function save()
    {
        if (! $this->hasValidSession()) {
            return redirect()->route('password.request');
        }

        $this->validate([
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.confirmed' => 'Las contrasenas no coinciden.',
        ]);

        $email = session('password_reset_email');
        $user = User::where('email', $email)->first();

        if (! $user) {
            return redirect()->route('password.request');
        }

        $user->update([
            'password' => Hash::make($this->password),
        ]);

        session()->forget([
            'password_reset_email',
            'password_reset_verified_at',
            'password_reset_resend_available_at',
        ]);

        return redirect()->route('login')->with('status', 'Contrasena actualizada. Inicia sesion.');
    }

    private function hasValidSession(): bool
    {
        $email = session('password_reset_email');
        $verifiedAt = session('password_reset_verified_at');

        if (! $email || ! $verifiedAt) {
            return false;
        }

        return (now()->timestamp - (int) $verifiedAt) <= (15 * 60);
    }

    public function render()
    {
        return view('livewire.auth.reset-password')->layout('layouts.app', [
            'title' => 'Nueva contrasena',
            'bodyClass' => 'min-h-screen bg-[#f2f4f6] text-slate-900 antialiased',
        ]);
    }
}
