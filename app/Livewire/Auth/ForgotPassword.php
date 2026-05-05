<?php

namespace App\Livewire\Auth;

use App\Mail\PasswordResetCodeMail;
use App\Models\PasswordResetCode;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ForgotPassword extends Component
{
    public string $email = '';
    public ?string $statusMessage = null;
    public ?string $errorMessage = null;

    public function sendCode()
    {
        $this->resetErrorBag();
        $this->statusMessage = null;
        $this->errorMessage = null;

        $this->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Ingresa tu correo.',
            'email.email' => 'Ingresa un correo valido.',
        ]);

        $cleanEmail = trim($this->email);
        $user = User::where('email', $cleanEmail)->first();

        if (! $user) {
            $this->errorMessage = 'No encontramos una cuenta con ese correo.';
            return null;
        }

        $code = $this->generateCode();

        PasswordResetCode::updateOrCreate(
            ['email' => $cleanEmail],
            [
                'code_hash' => Hash::make($code),
                'expires_at' => now()->addMinutes(10),
                'last_sent_at' => now(),
            ]
        );

        Mail::to($cleanEmail)->send(new PasswordResetCodeMail($code));

        session([
            'password_reset_email' => $cleanEmail,
            'password_reset_resend_available_at' => now()->addSeconds(30)->timestamp,
        ]);

        return redirect()->route('password.code', ['email' => $cleanEmail]);
    }

    private function generateCode(): string
    {
        return str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    public function render()
    {
        return view('livewire.auth.forgot-password')->layout('layouts.app', [
            'title' => 'Recuperar contrasena',
            'bodyClass' => 'min-h-screen bg-[#f2f4f6] text-slate-900 antialiased',
        ]);
    }
}
