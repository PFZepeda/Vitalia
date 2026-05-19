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
        'Amoxicilina' => ['base_dose' => 25, 'unit' => 'mg/kg', 'dosis_1' => 250, 'dosis_2' => 500],
        'Paracetamol' => ['base_dose' => 15, 'unit' => 'mg/kg', 'dosis_1' => 250, 'dosis_2' => 500],
        'Ibuprofeno' => ['base_dose' => 10, 'unit' => 'mg/kg', 'dosis_1' => 400, 'dosis_2' => 800],
        'Penicilina V' => ['base_dose' => 12.5, 'unit' => 'mg/kg', 'dosis_1' => 125, 'dosis_2' => 250],
        'Cefalexina' => ['base_dose' => 25, 'unit' => 'mg/kg', 'dosis_1' => 250, 'dosis_2' => 500],
        'Naproxeno' => ['base_dose' => 5, 'unit' => 'mg/kg', 'dosis_1' => 250, 'dosis_2' => 500],
        'Prednisona' => ['base_dose' => 1, 'unit' => 'mg/kg', 'dosis_1' => 5, 'dosis_2' => 20],
        'Sertralina' => ['base_dose' => 1, 'unit' => 'mg/kg', 'dosis_1' => 50, 'dosis_2' => 100],
        'Tramadol' => ['base_dose' => 1, 'unit' => 'mg/kg', 'dosis_1' => 50, 'dosis_2' => 100],
        'Dextrometorfano' => ['base_dose' => 0.5, 'unit' => 'mg/kg', 'dosis_1' => 15, 'dosis_2' => 30],
        'Difenhidramina' => ['base_dose' => 1.25, 'unit' => 'mg/kg', 'dosis_1' => 25, 'dosis_2' => 50],
    ];
    public $selectedMedication = null;
    public $selectedDosisLevel = 1; // 1 o 2
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
            if ($this->selectedMedication) {
                $this->selectedDosisLevel = $this->determineAutomaticDosisLevel();
                $this->calculateDosis();
            }
        }
    }

    public function updatedSelectedMedication()
    {
        $this->selectedDosisLevel = $this->determineAutomaticDosisLevel();
        $this->calculateDosis();
    }

    public function updatedDosisMethod()
    {
        if ($this->selectedMedication) {
            $this->calculateDosis();
        }
    }

    public function updatedSelectedDosisLevel()
    {
        if ($this->selectedMedication) {
            $this->calculateDosis();
        }
    }

    private function determineAutomaticDosisLevel(): int
    {
        if (!$this->patient) {
            return 1;
        }
        $age = $this->patient->getAge();
        return $age >= 12 ? 2 : 1;
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

        $maxDose = $this->selectedDosisLevel === 2 ? $medication['dosis_2'] : $medication['dosis_1'];

        $this->calculatedDosis = [
            'dose' => round($dose, 2),
            'dosis_level' => $this->selectedDosisLevel,
            'dosis_reference' => $maxDose,
            'max_dose' => max($medication['dosis_1'], $medication['dosis_2']),
            'unit' => $medication['unit'],
            'method' => $this->getMethodDescription(),
            'observations' => $this->getDosisObservations($dose, $maxDose),
        ];
    }

    private function calculateByWeight($medication)
    {
        if (!$this->patient->weight) {
            return 0;
        }

        $dose = ($this->patient->weight * $medication['base_dose']);
        $maxDose = $this->selectedDosisLevel === 2 ? $medication['dosis_2'] : $medication['dosis_1'];
        return min($dose, $maxDose);
    }

    private function calculateByAge($medication)
    {
        $age = $this->patient->getAge();
        // Fórmula de Young: (edad / edad + 12) × dosis de adulto
        // Asumimos dosis de adulto = 500mg como estándar
        $adultDose = 500;
        $dose = ($age / ($age + 12)) * $adultDose;
        $maxDose = $this->selectedDosisLevel === 2 ? $medication['dosis_2'] : $medication['dosis_1'];
        return min($dose, $maxDose);
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
        $maxDose = $this->selectedDosisLevel === 2 ? $medication['dosis_2'] : $medication['dosis_1'];
        return min($dose, $maxDose);
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
