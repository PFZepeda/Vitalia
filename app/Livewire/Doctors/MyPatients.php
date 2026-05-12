<?php

namespace App\Livewire\Doctors;

use App\Models\User;
use App\Support\RoleNames;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class MyPatients extends Component
{
    public $search = '';

    public function render()
    {
        $doctorId = Auth::id();
        $patients = User::whereHas('roles', function($q) {
            $q->where('name', RoleNames::PATIENT);
        })->whereIn('id', \App\Models\Prescription::where('doctor_id', $doctorId)->whereHas('medication')->select('patient_id'))
        ->when($this->search, function ($query) {
            $query->where('email', 'like', '%' . $this->search . '%');
        })->get();

        return view('livewire.doctors.my-patients', [
            'patients' => $patients,
        ]);
    }
}
