<?php

namespace App\Livewire\Pharmaceutical;

use App\Models\User;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\MedicationBrand;
use App\Models\PatientMedicationStock;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class MedicationStock extends Component
{
    public User $patient;
    public PrescriptionItem $item;
    public $prescription; // Una de las recetas para obtener dosis/unidad sugerida

    public $showModal = false;
    public $showSuccessMessage = false;
    public $showPatentDropdown = false;
    public $errorMessage = '';

    // Patentes seleccionadas para actualizar stock
    // [brand_id => ['boxes' => 0, 'pills_per_box' => X, 'name' => 'Y']]
    public $selectedPatents = [];

    private function selectedPatentsSessionKey(): string
    {
        return 'medication_stock.selected_patents.' . $this->patient->id . '.' . $this->item->id;
    }

    private function persistSelectedPatents(): void
    {
        session()->put($this->selectedPatentsSessionKey(), $this->selectedPatents);
    }

    public function mount(User $patient, PrescriptionItem $item)
    {
        $this->patient = $patient;
        $this->item = $item;

        // Obtener la receta actual para este medicamento y paciente
        $this->prescription = Prescription::where('patient_id', $patient->id)
            ->where('prescription_item_id', $item->id)
            ->first();

        $storedPatents = session()->get($this->selectedPatentsSessionKey(), []);
        if (!empty($storedPatents)) {
            $this->selectedPatents = $storedPatents;
        } else {
            // Inicializar con la patente sugerida que coincide con la dosis de la receta
            $suggestedBrandQuery = $this->item->brands()->where('is_suggested', true);
            if ($this->prescription) {
                $suggestedBrandQuery
                    ->where('dose', $this->prescription->dose)
                    ->where('dose_unit', $this->prescription->dose_unit);
            }
            $suggestedBrand = $suggestedBrandQuery->first();
            if ($suggestedBrand) {
                $this->addPatent($suggestedBrand->id);
            }
        }
    }

    public function addPatent($brandId)
    {
        $brand = MedicationBrand::find($brandId);
        if ($brand && !isset($this->selectedPatents[$brand->id])) {
            $this->selectedPatents[$brand->id] = [
                'id' => $brand->id,
                'name' => $brand->brand_name,
                'dose' => $brand->dose,
                'dose_unit' => $brand->dose_unit,
                'boxes' => 0,
                'pills_per_box' => $brand->pills_per_box
            ];
        }
        $this->showPatentDropdown = false;
        $this->persistSelectedPatents();
    }

    public function removePatent($brandId)
    {
        unset($this->selectedPatents[$brandId]);
        $this->persistSelectedPatents();
    }

    public function incrementBoxes($brandId)
    {
        if ($this->selectedPatents[$brandId]['boxes'] < 2) {
            $this->selectedPatents[$brandId]['boxes']++;
        }
        $this->persistSelectedPatents();
    }

    public function decrementBoxes($brandId)
    {
        if ($this->selectedPatents[$brandId]['boxes'] > 0) {
            $this->selectedPatents[$brandId]['boxes']--;
        }
        $this->persistSelectedPatents();
    }

    public function openModal()
    {
        $totalToSum = $this->getTotalToSum();
        
        if ($totalToSum > 0) {
            $currentStock = PatientMedicationStock::where('patient_id', $this->patient->id)
                ->where('prescription_item_id', $this->item->id)
                ->first();
            
            $currentCount = $currentStock->current_pills ?? 0;

            if (($currentCount + $totalToSum) > 30) {
                $this->errorMessage = 'El paciente ya cuenta con el máximo de pastillas';
                return;
            }

            $this->errorMessage = '';
            $this->showModal = true;
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->errorMessage = '';
    }

    public function getTotalToSum()
    {
        $total = 0;
        foreach ($this->selectedPatents as $patent) {
            $total += ($patent['boxes'] * $patent['pills_per_box']);
        }
        return $total;
    }

    public function saveChanges()
    {
        $totalToSum = $this->getTotalToSum();

        if ($totalToSum > 0) {
            $currentStock = PatientMedicationStock::where('patient_id', $this->patient->id)
                ->where('prescription_item_id', $this->item->id)
                ->first();
            
            $currentCount = $currentStock->current_pills ?? 0;

            if (($currentCount + $totalToSum) > 30) {
                $this->errorMessage = 'El paciente ya cuenta con el máximo de pastillas';
                $this->closeModal();
                return;
            }

            DB::transaction(function () use ($totalToSum) {
                $stock = PatientMedicationStock::firstOrCreate(
                    [
                        'patient_id' => $this->patient->id,
                        'prescription_item_id' => $this->item->id
                    ]
                );
                $stock->increment('current_pills', $totalToSum);
            });

            $this->showSuccessMessage = true;
            $this->closeModal();
            
            // Resetear contadores
            foreach ($this->selectedPatents as $id => $patent) {
                $this->selectedPatents[$id]['boxes'] = 0;
            }
            $this->persistSelectedPatents();
        }
    }

    public function togglePatentDropdown()
    {
        $this->showPatentDropdown = !$this->showPatentDropdown;
    }

    public function render()
    {
        $currentStock = PatientMedicationStock::where('patient_id', $this->patient->id)
            ->where('prescription_item_id', $this->item->id)
            ->first();

        $suggestedBrandQuery = $this->item->brands()->where('is_suggested', true);
        if ($this->prescription) {
            $suggestedBrandQuery
                ->where('dose', $this->prescription->dose)
                ->where('dose_unit', $this->prescription->dose_unit);
        }
        $suggestedBrand = $suggestedBrandQuery->first();
        
        // Otras patentes disponibles que no están seleccionadas, filtradas por dosis y unidad
        $otherBrandsQuery = $this->item->brands();
        if ($this->prescription) {
            $otherBrandsQuery
                ->where('dose', $this->prescription->dose)
                ->where('dose_unit', $this->prescription->dose_unit);
        }
        $otherBrands = $otherBrandsQuery
            ->whereNotIn('id', array_keys($this->selectedPatents))
            ->get();

        return view('livewire.pharmaceutical.medication-stock', [
            'currentStockCount' => $currentStock->current_pills ?? 0,
            'suggestedBrand' => $suggestedBrand,
            'otherBrands' => $otherBrands
        ]);
    }
}
