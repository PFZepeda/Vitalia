<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        $this->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Ingresa tu correo.',
            'email.email' => 'Ingresa un correo válido.',
            'password.required' => 'Ingresa tu contraseña.',
        ]);

        if (! Auth::guard('web')->attempt([
            'email' => trim($this->email),
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'email' => 'Credenciales inválidas.',
            ]);
        }

        // Antes de regenerar, capturamos el ID del usuario
        $userId = Auth::id();

        // Regeneramos la sesión para seguridad
        session()->regenerate();

        // Obtenemos el NUEVO ID de sesión
        $currentSessionId = session()->getId();
        
        if ($userId) {
            // Forzamos la vinculación del user_id con la sesión actual en la base de datos.
            // Esto es necesario para que la limpieza de otras sesiones funcione de inmediato.
            DB::table('sessions')
                ->where('id', $currentSessionId)
                ->update(['user_id' => $userId]);

            // Eliminar todas las demás sesiones activas de este usuario
            DB::table('sessions')
                ->where('user_id', $userId)
                ->where('id', '!=', $currentSessionId)
                ->delete();
        }

        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if ($user && ! $user->hasVerifiedEmail()) {
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
