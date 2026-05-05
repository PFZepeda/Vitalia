<?php

namespace App\Livewire\Pharmaceutical;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Dashboard - Farmacéutico')]
class Dashboard extends Component
{
    public string $pharmacistName = 'Usuario';

    public function mount(): void
    {
        $this->pharmacistName = Auth::user()?->name ?: 'Usuario';
    }

    public function render()
    {
        return view('livewire.pharmaceutical.dashboard');
    }
}
