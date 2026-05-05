<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $passwordVisible = false;

    public function togglePasswordVisibility(): void
    {
        $this->passwordVisible = ! $this->passwordVisible;
    }

    public function login()
    {
        $this->resetErrorBag();

        $cleanEmail = trim($this->email);

        if ($cleanEmail === '' || $this->password === '') {
            $this->addError('form', 'Ingresa tu correo y contrasena.');
            return null;
        }

        $this->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.email' => 'Ingresa un correo valido.',
        ]);

        if (! Auth::guard('web')->attempt([
            'email' => $cleanEmail,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'form' => 'Credenciales invalidas.',
            ]);
        }

        request()->session()->regenerate();

        if (! Auth::user()?->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        return redirect()->intended(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.app', [
            'title' => 'Iniciar sesion',
            'bodyClass' => 'min-h-screen bg-[#f2f4f6] text-slate-900 antialiased',
        ]);
    }
}
