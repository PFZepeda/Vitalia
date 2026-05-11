<?php

namespace App\Livewire\Doctors;

use App\Models\User;
use App\Support\RoleNames;
use Livewire\Component;

class MyPatients extends Component
{
    public $search = '';

    public function render()
    {
        $doctorId = auth()->id();
        $patients = User::whereHas('roles', function($q) {
            $q->where('name', RoleNames::PATIENT);
        })->whereIn('id', \App\Models\Prescription::where('doctor_id', $doctorId)->whereHas('items')->select('patient_id'))
        ->when($this->search, function ($query) {
            $query->where('email', 'like', '%' . $this->search . '%');
        })->get();

        return view('livewire.doctors.my-patients', [
            'patients' => $patients,
        ])->layout('layouts.app', [
            'title' => 'Mis pacientes',
            'bodyClass' => 'min-h-screen bg-white text-slate-900 antialiased',
        ]);
    }
}
