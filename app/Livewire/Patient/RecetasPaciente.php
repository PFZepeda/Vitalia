<?php

namespace App\Livewire\Patient;

use App\Models\Prescription;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RecetasPaciente extends Component
{
    public $prescriptions;
    public $showModal = false;
    public $selectedPrescriptionId = null;
    public $selectedObservations = null;

    public function mount(): void
    {
        $this->loadPrescriptions();
    }

    public function loadPrescriptions(): void
    {
        $userId = Auth::id();
        $user = Auth::user();

        // Si es cuidador, buscar el ID del paciente asignado
        if ($user && $user->hasRole(\App\Support\RoleNames::CAREGIVER)) {
            $assignment = \App\Models\CaregiverRequest::where('caregiver_id', $userId)
                ->where('status', 'accepted')
                ->first();
            
            if ($assignment) {
                $userId = $assignment->patient_id;
            } else {
                $this->prescriptions = collect();
                return;
            }
        }

        $this->prescriptions = Prescription::query()
            ->with(['medication', 'patient.medicationStocks'])
            ->where('patient_id', $userId)
            ->latest('start_date')
            ->latest('created_at')
            ->get();
    }

    public function openModal($recipeId)
    {
        $prescription = $this->prescriptions?->firstWhere('id', $recipeId);
        if (! $prescription) {
            $prescription = Prescription::query()
                ->where('patient_id', Auth::id())
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
}
