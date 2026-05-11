<?php

namespace App\Livewire\Doctors;

use App\Models\User;
use Livewire\Component;

class PatientInfo extends Component
{
    public User $patient;
    public $isAssigned = false;
    public $activeTab = 'receta';

    public $editingHeight = false;
    public $height;

    public $editingWeight = false;
    public $weight;

    public $showMedicationModal = false;
    public $searchMedication = '';
    public $selectedMedication = '';
    public $dose = '';
    public $doseUnit = 'mg';
    public $frequency = '';
    public $observations = '';

    public $medicationsList = [
        'Amoxicilina', 'Paracetamol', 'Ibuprofeno', 'Omeprazol', 'Losartán',
        'Metformina', 'Atorvastatina', 'Aspirina', 'Azitromicina', 'Diclofenaco',
        'Ciprofloxacino', 'Levotiroxina', 'Loratadina', 'Tramadol', 'Diazepam',
        'Clonazepam', 'Enalapril', 'Naproxeno', 'Ketorolaco', 'Fluoxetina',
    ];

    public function getFilteredMedicationsProperty()
    {
        if (empty($this->searchMedication)) {
            return collect($this->medicationsList);
        }
        return collect($this->medicationsList)->filter(function($med) {
            return stripos($med, $this->searchMedication) !== false;
        })->values();
    }

    protected function rules()
    {
        return [
            'height' => ['required', 'numeric', 'min:0.01', 'max:3'],
            'weight' => ['required', 'numeric', 'min:2', 'max:800'],
        ];
    }

    protected $messages = [
        'height.required' => 'La altura es obligatoria.',
        'height.numeric' => 'La altura debe ser un número.',
        'height.min' => 'La altura debe ser mayor a 0.',
        'height.max' => 'La altura máxima es de 3 metros.',
        'weight.required' => 'El peso es obligatorio.',
        'weight.numeric' => 'El peso debe ser un número.',
        'weight.min' => 'El peso mínimo es 2 kg.',
        'weight.max' => 'El peso máximo es 800 kg.',
    ];

    public function mount(User $user)
    {
        $this->patient = $user;
        $this->height = $user->height;
        $this->weight = $user->weight;
        $this->checkAssigned();
    }

    public function checkAssigned()
    {
        $this->isAssigned = \App\Models\Prescription::where('doctor_id', auth()->id())
            ->where('patient_id', $this->patient->id)
            ->whereHas('items')
            ->exists();
    }

    public function editHeight()
    {
        if(!$this->isAssigned) return;
        $this->editingHeight = true;
    }

    public function saveHeight()
    {
        if(!$this->isAssigned) return;
        $this->validateOnly('height');
        $this->patient->height = $this->height;
        $this->patient->save();
        $this->editingHeight = false;
    }

    public function cancelHeight()
    {
        $this->height = $this->patient->height;
        $this->editingHeight = false;
        $this->resetValidation('height');
    }

    public function editWeight()
    {
        if(!$this->isAssigned) return;
        $this->editingWeight = true;
    }

    public function saveWeight()
    {
        if(!$this->isAssigned) return;
        $this->validateOnly('weight');
        $this->patient->weight = $this->weight;
        $this->patient->save();
        $this->editingWeight = false;
    }

    public function cancelWeight()
    {
        $this->weight = $this->patient->weight;
        $this->editingWeight = false;
        $this->resetValidation('weight');
    }

    public function openMedicationModal()
    {
        $this->reset(['selectedMedication', 'searchMedication', 'dose', 'doseUnit', 'frequency', 'observations']);
        $this->doseUnit = 'mg';
        $this->showMedicationModal = true;
    }

    public function selectMedication($med)
    {
        $this->selectedMedication = $med;
        $this->searchMedication = '';
    }

    public function savePrescriptionItem()
    {
        $this->validate([
            'selectedMedication' => 'required|string',
            'dose' => 'required|numeric',
            'doseUnit' => 'required|in:mg,mL',
            'frequency' => 'required|string|max:255',
            'observations' => 'nullable|string',
        ], [
            'selectedMedication.required' => 'El medicamento es obligatorio.',
            'dose.required' => 'La dosis es obligatoria.',
            'dose.numeric' => 'La dosis debe ser un número.',
            'frequency.required' => 'La frecuencia es obligatoria.',
        ]);

        if ($this->doseUnit === 'mg') {
            $this->validate([
                'dose' => 'min:1|max:1000'
            ], [
                'dose.min' => 'La dosis mínima es 1 mg.',
                'dose.max' => 'La dosis máxima es 1000 mg.'
            ]);
        } elseif ($this->doseUnit === 'mL') {
            $this->validate([
                'dose' => 'min:1|max:100'
            ], [
                'dose.min' => 'La dosis mínima es 1 mL.',
                'dose.max' => 'La dosis máxima es 100 mL.'
            ]);
        }

        $prescription = \App\Models\Prescription::firstOrCreate([
            'doctor_id' => auth()->id(),
            'patient_id' => $this->patient->id,
        ]);

        \App\Models\PrescriptionItem::create([
            'prescription_id' => $prescription->id,
            'medication_name' => $this->selectedMedication,
            'dose' => $this->dose,
            'dose_unit' => $this->doseUnit,
            'frequency' => $this->frequency,
            'observations' => $this->observations,
        ]);

        $this->showMedicationModal = false;
        $this->checkAssigned();
    }

    public function deleteItem($id)
    {
        $item = \App\Models\PrescriptionItem::find($id);
        if ($item && $item->prescription->doctor_id === auth()->id()) {
            $item->delete();
            $this->checkAssigned();
        }
    }

    public function getMyPrescriptionItemsProperty()
    {
        return \App\Models\PrescriptionItem::whereHas('prescription', function($q) {
            $q->where('doctor_id', auth()->id())->where('patient_id', $this->patient->id);
        })->latest()->get();
    }

    public function getAllPrescriptionItemsProperty()
    {
        return \App\Models\PrescriptionItem::withTrashed()->with('prescription.doctor')->whereHas('prescription', function($q) {
            $q->where('patient_id', $this->patient->id);
        })->latest()->get();
    }

    public function render()
    {
        return view('livewire.doctors.patient-info')->layout('layouts.app', [
            'title' => 'Crear Receta',
            'bodyClass' => 'min-h-screen bg-white text-slate-900 antialiased',
        ]);
    }
}
