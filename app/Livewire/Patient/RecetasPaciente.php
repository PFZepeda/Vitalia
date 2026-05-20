<?php

namespace App\Livewire\Patient;

use App\Models\Prescription;
use App\Support\RoleNames;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RecetasPaciente extends Component
{
    public $prescriptions;
    public $showModal = false;
    public $selectedPrescriptionId = null;
    public $selectedObservations = null;
    public $patientId = null;

    public function mount(): void
    {
        $this->patientId = $this->resolvePatientId();
        $this->loadPrescriptions();
    }

    public function loadPrescriptions(): void
    {
        $patientId = $this->patientId ?? $this->resolvePatientId();
        $this->patientId = $patientId;
        if (! $patientId) {
            $this->prescriptions = collect();
            return;
        }

        $this->prescriptions = Prescription::query()
            ->with(['medication', 'patient.medicationStocks'])
            ->where('patient_id', $patientId)
            ->latest('start_date')
            ->latest('created_at')
            ->get();
    }

    public function openModal($recipeId)
    {
        $prescription = $this->prescriptions?->firstWhere('id', $recipeId);
        if (! $prescription) {
            $prescription = Prescription::query()
                ->where('patient_id', $this->patientId ?? Auth::id())
                ->find($recipeId);
        }

        if (! $prescription) {
            return;
        }

        $this->selectedPrescriptionId = $prescription->id;
        $this->selectedObservations = $prescription->observations;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedPrescriptionId = null;
        $this->selectedObservations = null;
    }

    public function render()
    {
        return view('livewire.patient.recetas-paciente');
    }

    private function resolvePatientId(): ?int
    {
        $user = Auth::user();
        if (! $user) {
            return null;
        }

        if (! $user->hasRole(RoleNames::CAREGIVER)) {
            return $user->id;
        }

        $assignment = \App\Models\CaregiverRequest::where('caregiver_id', $user->id)
            ->where('status', 'accepted')
            ->first();

        return $assignment?->patient_id;
    }
}
