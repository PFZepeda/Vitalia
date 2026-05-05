<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
#[Title('Mi perfil')]
class Dashboard extends Component
{
    use WithFileUploads;

    public string $ownerName = '';
    public string $email = '';
    public ?string $profilePhotoPath = null;
    public $photo = null;
    public ?string $statusMessage = null;

    public function mount(): void
    {
        $user = Auth::user();

        $this->ownerName = $user?->name ?: 'Usuario';
        $this->email = $user?->email ?: '';
        $this->profilePhotoPath = $user?->profile_photo_path;
    }

    public function getInitialsProperty(): string
    {
        $parts = preg_split('/\s+/', trim($this->ownerName)) ?: [];

        $first = mb_substr((string) ($parts[0] ?? 'U'), 0, 1);
        $last = mb_substr((string) ($parts[1] ?? ''), 0, 1);

        return mb_strtoupper($first . $last);
    }

    public function getProfilePhotoUrlProperty(): ?string
    {
        if (! $this->profilePhotoPath) {
            return null;
        }

        return asset('storage/' . $this->profilePhotoPath);
    }

    public function updatedPhoto(): void
    {
        $this->validate([
            'photo' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        if (! $user instanceof User) {
            abort(403);
        }

        $path = $this->photo->store('profile-photos', 'public');

        $user->forceFill([
            'profile_photo_path' => $path,
        ])->save();

        $this->profilePhotoPath = $path;
        $this->photo = null;
        $this->statusMessage = 'Foto de perfil actualizada.';
    }

    public function render()
    {
        return view('profile.dashboard');
    }
}