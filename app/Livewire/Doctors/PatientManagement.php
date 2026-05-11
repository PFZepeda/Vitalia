<?php

namespace App\Livewire\Doctors;

use App\Models\User;
use App\Support\RoleNames;
use Livewire\Component;

class PatientManagement extends Component
{
    public $search = '';

    public function render()
    {
        $patients = User::whereHas('roles', function($q) {
            $q->where('name', RoleNames::PATIENT);
        })->when($this->search, function ($query) {
            $query->where('email', 'like', '%' . $this->search . '%');
        })->get();

        return view('livewire.doctors.patient-management', [
            'patients' => $patients,
        ])->layout('layouts.app', [
            'title' => 'Gestión de Pacientes',
            'bodyClass' => 'min-h-screen bg-white text-slate-900 antialiased',
        ]);
    }
}
