<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard')->layout('layouts.app', [
            'title' => 'Dashboard',
            'bodyClass' => 'min-h-screen bg-slate-50 text-slate-900 antialiased',
        ]);
    }
}
