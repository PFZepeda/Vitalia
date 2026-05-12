<?php

namespace App\Livewire\Auth;

use App\Mail\PasswordResetCodeMail;
use App\Models\PasswordResetCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]

class ValidateCode extends Component
{
    public string $email = '';
    public string $code = '';
    public ?string $statusMessage = null;
    public ?string $errorMessage = null;

    public function mount(Request $request)
    {
        $this->email = $request->query('email', session('password_reset_email', ''));

        if ($this->email === '') {
            return redirect()->route('password.request');
        }

        session(['password_reset_email' => $this->email]);

        return null;
    }

    public function getCooldownRemainingProperty(): int
    {
        $timestamp = session('password_reset_resend_available_at');
        if (! $timestamp) {
            return 0;
        }

        $remaining = (int) $timestamp - now()->timestamp;

        return $remaining > 0 ? $remaining : 0;
    }

    public function verifyCode()
    {
        $this->resetErrorBag();
        $this->statusMessage = null;
        $this->errorMessage = null;

        $this->validate([
            'code' => 'required|digits:6',
        ], [
            'code.required' => 'Ingresa tu codigo.',
            'code.digits' => 'Codigo invalido.',
        ]);

        $record = PasswordResetCode::where('email', $this->email)->first();

        if (! $record || $record->expires_at->isPast()) {
            $this->errorMessage = 'Codigo invalido.';
            return null;
        }

        if (! Hash::check($this->code, $record->code_hash)) {
            $this->errorMessage = 'Codigo invalido.';
            return null;
        }

        $record->delete();

        session([
            'password_reset_email' => $this->email,
            'password_reset_verified_at' => now()->timestamp,
        ]);

        return redirect()->route('password.reset');
    }

    public function resendCode()
    {
        $this->statusMessage = null;
        $this->errorMessage = null;

        if ($this->cooldownRemaining > 0) {
            return null;
        }

        $user = User::where('email', $this->email)->first();
        if (! $user) {
            $this->errorMessage = 'No encontramos una cuenta con ese correo.';
            return null;
        }

        $code = $this->generateCode();

        PasswordResetCode::updateOrCreate(
            ['email' => $this->email],
            [
                'code_hash' => Hash::make($code),
                'expires_at' => now()->addMinutes(10),
                'last_sent_at' => now(),
            ]
        );

        Mail::to($this->email)->send(new PasswordResetCodeMail($code));

        session(['password_reset_resend_available_at' => now()->addSeconds(30)->timestamp]);

        $this->statusMessage = 'Se envio un nuevo codigo.';

        return null;
    }

    private function generateCode(): string
    {
        return str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    public function render()
    {
        return view('livewire.auth.validate-code');
    }
}
