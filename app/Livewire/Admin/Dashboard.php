<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Admin Dashboard')]
class Dashboard extends Component
{
    public string $ownerName = 'Administrador';

    public function mount(): void
    {
        $this->ownerName = Auth::user()?->name ?: 'Administrador';
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}