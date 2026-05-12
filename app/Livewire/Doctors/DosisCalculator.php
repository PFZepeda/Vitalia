<?php

namespace App\Livewire\Doctors;

use App\Models\Prescription;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;

class DosisCalculator extends Component
{
    public $patients = [];
    public $selectedPatientId = null;
    public $patient = null;
    public $medications = [
        'Amoxicilina' => ['base_dose' => 25, 'unit' => 'mg/kg', 'max' => 500],
        'Paracetamol' => ['base_dose' => 15, 'unit' => 'mg/kg', 'max' => 500],
        'Ibuprofeno' => ['base_dose' => 10, 'unit' => 'mg/kg', 'max' => 400],
        'Penicilina V' => ['base_dose' => 12.5, 'unit' => 'mg/kg', 'max' => 250],
        'Cefalexina' => ['base_dose' => 25, 'unit' => 'mg/kg', 'max' => 500],
    ];
    public $selectedMedication = null;
    public $calculatedDosis = null;
    public $dosisMethod = 'weight'; // weight, age, bsa

    public function mount()
    {
        $this->patients = User::role(['patient', 'caregiver'])
            ->orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedSelectedPatientId($value)
    {
        if ($value) {
            $this->patient = User::find($value);
        }
    }

    public function updatedSelectedMedication()
    {
        $this->calculateDosis();
    }

    public function updatedDosisMethod()
    {
        if ($this->selectedMedication) {
            $this->calculateDosis();
        }
    }

    public function calculateDosis()
    {
        if (!$this->patient || !$this->selectedMedication) {
            return;
        }

        $medication = $this->medications[$this->selectedMedication] ?? null;
        if (!$medication) {
            return;
        }

        $dose = match ($this->dosisMethod) {
            'weight' => $this->calculateByWeight($medication),
            'age' => $this->calculateByAge($medication),
            'bsa' => $this->calculateByBSA($medication),
            default => 0,
        };

        $this->calculatedDosis = [
            'dose' => round($dose, 2),
            'max_dose' => $medication['max'],
            'unit' => $medication['unit'],
            'method' => $this->getMethodDescription(),
            'observations' => $this->getDosisObservations($dose, $medication['max']),
        ];
    }

    private function calculateByWeight($medication)
    {
        if (!$this->patient->weight) {
            return 0;
        }

        $dose = ($this->patient->weight * $medication['base_dose']);
        return min($dose, $medication['max']);
    }

    private function calculateByAge($medication)
    {
        $age = $this->patient->getAge();
        // Fórmula de Young: (edad / edad + 12) × dosis de adulto
        // Asumimos dosis de adulto = 500mg como estándar
        $adultDose = 500;
        $dose = ($age / ($age + 12)) * $adultDose;
        return min($dose, $medication['max']);
    }

    private function calculateByBSA($medication)
    {
        // Fórmula de Mosteller: BSA = √[(altura(cm) × peso(kg)) / 3600]
        if (!$this->patient->height || !$this->patient->weight) {
            return 0;
        }

        $bsa = sqrt(($this->patient->height * $this->patient->weight) / 3600);
        // Dosis pediátrica por BSA = (BSA / 1.73) × dosis de adulto
        $adultDose = 500;
        $dose = ($bsa / 1.73) * $adultDose;
        return min($dose, $medication['max']);
    }

    public function getAge()
    {
        if (!$this->patient || !$this->patient->birth_date) {
            return 0;
        }
        return Carbon::parse($this->patient->birth_date)->age;
    }

    private function getMethodDescription()
    {
        return match ($this->dosisMethod) {
            'weight' => 'Calculada por peso (Clark)',
            'age' => 'Calculada por edad (Young)',
            'bsa' => 'Calculada por superficie corporal (Mosteller)',
            default => 'Desconocido',
        };
    }

    private function getDosisObservations($dose, $maxDose)
    {
        $observations = [];

        if ($this->patient->getAge() < 2) {
            $observations[] = '⚠️ Paciente menor de 2 años - Consultar pediatra';
        }

        if ($dose > $maxDose) {
            $observations[] = "⚠️ Dosis calculada excede el máximo recomendado ($maxDose)";
        }

        if (!$this->patient->weight) {
            $observations[] = "⚠️ Peso no registrado - Resultado puede no ser preciso";
        }

        if (!$this->patient->height && $this->dosisMethod === 'bsa') {
            $observations[] = "⚠️ Altura no registrada - Resultado puede no ser preciso";
        }

        return $observations;
    }

    public function render()
    {
        return view('livewire.doctors.dosis-calculator');
    }
}
