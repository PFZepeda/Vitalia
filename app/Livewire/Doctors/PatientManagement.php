<?php

namespace App\Livewire\Doctors;

use App\Models\User;
use App\Support\RoleNames;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class PatientManagement extends Component
{
    public $search = '';
    public $selectedPatient = null;
    public $showReportsModal = false;

    public function openReportsModal($patientId)
    {
        $this->selectedPatient = User::with(['prescriptions.medication'])->find($patientId);
        $this->showReportsModal = true;
    }

    public function closeReportsModal()
    {
        $this->showReportsModal = false;
        $this->selectedPatient = null;
    }

    public function render()
    {
        $patients = User::whereHas('roles', function($q) {
            $q->where('name', RoleNames::PATIENT);
        })->when($this->search, function ($query) {
            $query->where('email', 'like', '%' . $this->search . '%');
        })->get();

        return view('livewire.doctors.patient-management', [
            'patients' => $patients,
        ]);
    }
}
