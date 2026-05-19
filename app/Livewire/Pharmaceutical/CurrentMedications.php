<?php

namespace App\Livewire\Pharmaceutical;

use App\Models\User;
use App\Models\Prescription;
use App\Models\PatientMedicationStock;
use Livewire\Component;

class CurrentMedications extends Component
{
    public User $patient;

    public function mount(User $patient)
    {
        $this->patient = $patient;
    }

    public function render()
    {
        // Obtener medicamentos recetados únicos para este paciente
        $prescriptions = Prescription::where('patient_id', $this->patient->id)
            ->with(['medication', 'medication.brands'])
            ->get()
            ->unique('prescription_item_id');

        // Obtener el stock actual del paciente
        $stocks = PatientMedicationStock::where('patient_id', $this->patient->id)
            ->get()
            ->keyBy('prescription_item_id');

        return view('livewire.pharmaceutical.current-medications', [
            'prescriptions' => $prescriptions,
            'stocks' => $stocks
        ]);
    }
}
