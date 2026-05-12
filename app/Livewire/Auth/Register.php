<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Support\RoleNames;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Layout('layouts.app')]

class Register extends Component
{
    private const SEX_OPTIONS = [
        ['label' => 'Hombre', 'value' => 'male'],
        ['label' => 'Mujer', 'value' => 'female'],
    ];

    private const COUNTRY_CODES = [
        ['label' => 'Mexico', 'value' => '+52'],
        ['label' => 'Chile', 'value' => '+56'],
        ['label' => 'Argentina', 'value' => '+54'],
        ['label' => 'Bolivia', 'value' => '+591'],
        ['label' => 'Brasil', 'value' => '+55'],
        ['label' => 'Colombia', 'value' => '+57'],
        ['label' => 'Costa Rica', 'value' => '+506'],
        ['label' => 'Ecuador', 'value' => '+593'],
        ['label' => 'El Salvador', 'value' => '+503'],
        ['label' => 'Espana', 'value' => '+34'],
        ['label' => 'Estados Unidos', 'value' => '+1'],
        ['label' => 'Guatemala', 'value' => '+502'],
        ['label' => 'Honduras', 'value' => '+504'],
        ['label' => 'Nicaragua', 'value' => '+505'],
        ['label' => 'Panama', 'value' => '+507'],
        ['label' => 'Paraguay', 'value' => '+595'],
        ['label' => 'Peru', 'value' => '+51'],
        ['label' => 'Republica Dominicana', 'value' => '+1'],
        ['label' => 'Uruguay', 'value' => '+598'],
        ['label' => 'Venezuela', 'value' => '+58'],
    ];

    private const SECURITY_QUESTIONS = [
        'Cual es el nombre de tu primera mascota?',
        'Cual es el nombre de tu escuela primaria?',
        'En que ciudad naciste?',
        'Cual es tu comida favorita?',
        'Cual es el nombre de tu mejor amigo de la infancia?',
    ];

    public array $sexOptions = [];
    public array $countryOptions = [];
    public array $securityOptions = [];

    public string $name = '';
    public string $email = '';
    public string $countryCode = '+52';
    public string $phoneLocal = '';
    public string $securityQuestion = '';
    public string $securityAnswer = '';
    public string $sex = '';
    public ?string $birthDate = null;
    public string $password = '';
    public string $password_confirmation = '';

    public bool $passwordVisible = false;
    public bool $confirmPasswordVisible = false;

    public function mount(): void
    {
        $this->sexOptions = self::SEX_OPTIONS;
        $this->countryOptions = self::COUNTRY_CODES;
        $this->securityOptions = self::SECURITY_QUESTIONS;
        $this->countryCode = self::COUNTRY_CODES[0]['value'];
    }

    public function togglePasswordVisibility(): void
    {
        $this->passwordVisible = ! $this->passwordVisible;
    }

    public function toggleConfirmPasswordVisibility(): void
    {
        $this->confirmPasswordVisible = ! $this->confirmPasswordVisible;
    }

    public function register()
    {
        $this->resetErrorBag();

        $this->email = trim($this->email);
        $this->name = trim($this->name);
        $this->securityAnswer = trim($this->securityAnswer);

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'countryCode' => 'required|string|max:8',
            'phoneLocal' => 'required|string|max:32',
            'securityQuestion' => 'required|string|max:255',
            'securityAnswer' => 'required|string|max:255',
            'sex' => 'required|in:male,female',
            'birthDate' => 'required|date|before:today',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.confirmed' => 'Las contrasenas no coinciden.',
            'birthDate.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
        ]);

        $phone = $this->buildPhoneE164($this->countryCode, $this->phoneLocal);
        if ($phone === '') {
            $this->addError('phoneLocal', 'Completa el telefono con un formato valido.');
            return null;
        }

        if (User::where('phone', $phone)->exists()) {
            $this->addError('phoneLocal', 'El telefono ya esta registrado.');
            return null;
        }

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone' => $phone,
            'phone_country_code' => $this->countryCode,
            'phone_local' => $this->normalizePhoneDigits($this->phoneLocal),
            'security_question' => $this->securityQuestion,
            'security_answer' => Hash::make($this->securityAnswer),
            'sex' => $this->sex,
            'birth_date' => $this->birthDate,
        ]);

        $patientRole = Role::findOrCreate(RoleNames::PATIENT, 'web');
        $user->assignRole($patientRole);

        event(new Registered($user));
        Auth::guard('web')->login($user);
        request()->session()->regenerate();

        return redirect()->route('verification.notice');
    }

    private function buildPhoneE164(string $countryCode, string $localNumber): string
    {
        $cleanCode = $this->normalizePhoneDigits($countryCode);
        $cleanLocal = $this->normalizePhoneDigits($localNumber);

        if ($cleanCode === '' || $cleanLocal === '') {
            return '';
        }

        return sprintf('+%s%s', $cleanCode, $cleanLocal);
    }

    private function normalizePhoneDigits(string $value): string
    {
        return preg_replace('/\D+/', '', $value) ?? '';
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
