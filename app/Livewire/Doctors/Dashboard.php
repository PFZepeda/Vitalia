<?php

namespace App\Livewire\Doctors;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Dashboard - Doctor')]
class Dashboard extends Component
{
    public string $doctorName = 'Doctor';

    public function mount(): void
    {
        $doctor = Auth::user();
        $this->doctorName = $doctor?->name ?: 'Doctor';
    }

    public function render()
    {
        return view('livewire.doctors.dashboard');
    }
}
