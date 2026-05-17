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
        $this->prescriptions = Prescription::query()
            ->with('medication')
            ->where('patient_id', Auth::id())
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
