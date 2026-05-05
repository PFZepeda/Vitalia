<?php

namespace App\Livewire\Caregiver;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Dashboard - Cuidador')]
class Dashboard extends Component
{
    public string $caregiverName = 'Cuidador';

    public function mount(): void
    {
        $this->caregiverName = Auth::user()?->name ?: 'Cuidador';
    }

    public function render()
    {
        return view('livewire.caregiver.dashboard');
    }
}
