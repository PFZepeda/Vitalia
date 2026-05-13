<?php

namespace App\Livewire\Doctors;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Carbon\Carbon;

#[Layout('layouts.app')]

class PatientInfo extends Component
{
    public User $patient;
    public $isAssigned = false;
    public $activeTab = 'receta';

    public $height;
    public $weight;
    public $showEditModal = false;

    public $showMedicationModal = false;
    public $searchMedication = '';
    public $selectedMedication = '';
    public $dose = '';
    public $doseUnit = 'mg';
    public $frequency = '';
    public $observations = '';
    public $editItemId = null;

    public $showDeleteConfirmModal = false;
    public $itemToDelete = null;

    public $showDatesModal = false;
    public $startDate = '';
    public $endDate = '';
    public $startHour = 12;
    public $startMinute = 0;
    public $startTimeFormat = 'a.m.';
    public $isPm = false;
    public $selectedDaysString = '';
    public $currentItemForDates = null;
    public $pastHourError = null;

    // Propiedades para cálculo de dosis
    public $calculatedDosis = null;
    public $dosisMethod = 'weight'; // weight, age, bsa
    
    // Medicamentos disponibles con información de dosis
    public $medicationsList = [
        'Ibuprofeno' => ['base_dose' => 10, 'presentation_unit' => 'mg/kg', 'dose_unit' => 'mg', 'max' => 400],
        'Naproxeno' => ['base_dose' => 5, 'presentation_unit' => 'mg/kg', 'dose_unit' => 'mg', 'max' => 250],
        'Prednisona' => ['base_dose' => 0.5, 'presentation_unit' => 'mg/kg', 'dose_unit' => 'mg', 'max' => 50],
        'Sertralina' => ['base_dose' => 2, 'presentation_unit' => 'mg/kg', 'dose_unit' => 'mg', 'max' => 100],
        'Tramadol' => ['base_dose' => 1, 'presentation_unit' => 'mg/kg', 'dose_unit' => 'mg', 'max' => 100],
        'Dextrometrofano' => ['base_dose' => 0.5, 'presentation_unit' => 'mg/kg', 'dose_unit' => 'mg', 'max' => 30],
        'Difenhidramina' => ['base_dose' => 1.25, 'presentation_unit' => 'mg/kg', 'dose_unit' => 'mg', 'max' => 50],
    ];

    public function getFilteredMedicationsProperty()
    {
        $medNames = array_keys($this->medicationsList);
        
        if (empty($this->searchMedication)) {
            return collect($medNames);
        }
        
        return collect($medNames)->filter(function($med) {
            return stripos($med, $this->searchMedication) !== false;
        })->values();
    }

    protected function rules()
    {
        return [
            'height' => ['required', 'numeric', 'min:0.5', 'max:3'],
            'weight' => ['required', 'numeric', 'min:0', 'max:300'],
        ];
    }

    #[\Livewire\Attributes\On('updated-dosisMethod')]
    public function onDosisMethodUpdated()
    {
        $this->calculateDosis();
    }

    protected $messages = [
        'height.required' => 'La altura es obligatoria.',
        'height.numeric' => 'La altura debe ser un número.',
        'height.min' => 'La altura mínima es 0.5 metros.',
        'height.max' => 'La altura máxima es de 3 metros.',
        'weight.required' => 'El peso es obligatorio.',
        'weight.numeric' => 'El peso debe ser un número.',
        'weight.min' => 'El peso no puede ser negativo.',
        'weight.max' => 'El peso máximo es 300 kg.',
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
        $this->isAssigned = \App\Models\Prescription::where('doctor_id', Auth::id())
            ->where('patient_id', $this->patient->id)
            ->exists();
    }

    public function saveHeight()
    {
        $this->validateOnly('height');
        $this->patient->height = $this->height;
        $this->patient->save();
        $this->showEditModal = false;
        session()->flash('success', 'Altura actualizada correctamente.');
    }

    public function saveWeight()
    {
        $this->validateOnly('weight');
        $this->patient->weight = $this->weight;
        $this->patient->save();
        $this->showEditModal = false;
        session()->flash('success', 'Peso actualizado correctamente.');
    }

    public function openMedicationModal()
    {
        $this->reset(['selectedMedication', 'searchMedication', 'dose', 'doseUnit', 'frequency', 'observations', 'editItemId', 'startDate', 'endDate', 'startHour', 'startMinute', 'startTimeFormat', 'selectedDaysString', 'currentItemForDates', 'isPm']);
        $this->doseUnit = 'mg';
        $this->startHour = 12;
        $this->startMinute = 0;
        $this->startTimeFormat = 'a.m.';
        $this->isPm = false;
        $this->showMedicationModal = true;
    }

    public function editItem($id)
    {
        $prescription = \App\Models\Prescription::find($id);
        if ($prescription && $prescription->doctor_id === Auth::id()) {
            $this->editItemId = $prescription->id;
            $this->currentItemForDates = $prescription->id;
            $this->selectedMedication = $prescription->medication?->medication_name ?? '';
            $this->dose = $prescription->dose + 0; // Remove trailing zeros
            $this->doseUnit = $prescription->dose_unit;
            $this->observations = $prescription->observations;
            
            // Cargar fechas del prescription
            $this->startDate = $prescription->start_date ? $prescription->start_date->format('Y-m-d') : '';
            $this->endDate = $prescription->end_date ? $prescription->end_date->format('Y-m-d') : '';
            $this->selectedDaysString = $prescription->weekdays ?? '';
            
            // Cargar hora de administración
            if ($prescription->administration_time) {
                $time = \Carbon\Carbon::parse($prescription->administration_time);
                $this->startHour = (int) $time->format('h');
                $this->startMinute = (int) $time->format('i');
                $this->startTimeFormat = $time->format('A') === 'AM' ? 'a.m.' : 'p.m.';
                $this->isPm = $time->format('A') === 'PM';
            }
            
            // Calcular la dosis para mostrar todos los datos
            $this->calculateDosis();
            
            $this->showMedicationModal = true;
        }
    }

    public function selectMedication($med)
    {
        $this->selectedMedication = $med;
        $this->searchMedication = '';
        $this->calculateDosis();
    }

    public function calculateDosis()
    {
        if (!$this->selectedMedication) {
            $this->calculatedDosis = null;
            $this->dose = '';
            return;
        }

        $medication = $this->medicationsList[$this->selectedMedication] ?? null;
        if (!$medication) {
            $this->calculatedDosis = null;
            $this->dose = '';
            return;
        }

        // Establecer automáticamente la unidad de dosis según el medicamento
        $this->doseUnit = $medication['dose_unit'];

        $dose = match ($this->dosisMethod) {
            'weight' => $this->calculateByWeight($medication),
            'age' => $this->calculateByAge($medication),
            'bsa' => $this->calculateByBSA($medication),
            default => 0,
        };

        $this->calculatedDosis = [
            'dose' => round($dose, 2),
            'max_dose' => $medication['max'],
            'unit' => $medication['dose_unit'],
            'presentation_unit' => $medication['presentation_unit'],
            'method' => $this->getMethodDescription(),
            'observations' => $this->getDosisObservations($dose, $medication['max']),
        ];

        // Establecer la dosis calculada
        $this->dose = $this->calculatedDosis['dose'];
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
        $age = $this->getAge();
        if (!$age) {
            return 0;
        }
        // Fórmula de Young: (edad / edad + 12) × dosis de adulto
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

        $heightCm = $this->patient->height * 100;
        $bsa = sqrt(($heightCm * $this->patient->weight) / 3600);
        // Dosis pediátrica por BSA = (BSA / 1.73) × dosis de adulto
        $adultDose = 500;
        $dose = ($bsa / 1.73) * $adultDose;
        return min($dose, $medication['max']);
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

        $age = $this->getAge();
        if ($age && $age < 2) {
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

    public function savePrescriptionItem()
    {
        $this->validate([
            'selectedMedication' => 'required|string',
            'dose' => 'required|numeric',
            'doseUnit' => 'required|in:mg,mL',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'selectedDaysString' => 'required|string',
            'observations' => 'nullable|string|max:255',
        ], [
            'selectedMedication.required' => 'El medicamento es obligatorio.',
            'dose.required' => 'La dosis es obligatoria.',
            'dose.numeric' => 'La dosis debe ser un número.',
            'startDate.required' => 'La fecha de inicio es obligatoria.',
            'startDate.date' => 'La fecha de inicio debe ser una fecha válida.',
            'endDate.required' => 'La fecha de fin es obligatoria.',
            'endDate.date' => 'La fecha de fin debe ser una fecha válida.',
            'endDate.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la de inicio.',
            'selectedDaysString.required' => 'Debes seleccionar al menos un día de la semana.',
            'observations.max' => 'Las observaciones no pueden exceder 255 caracteres.',
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

        // Obtener o crear el medicamento de referencia (PrescriptionItem)
        $prescriptionItem = \App\Models\PrescriptionItem::firstOrCreate(
            ['medication_name' => $this->selectedMedication],
            ['medication_name' => $this->selectedMedication]
        );

        // Preparar datos de fechas
        $dateData = [];
        if (!empty($this->startDate) && !empty($this->endDate)) {
            // Convertir hora a formato 24h
            $hour24 = $this->startHour;
            if ($this->startTimeFormat === 'p.m.' && $this->startHour !== 12) {
                $hour24 = $this->startHour + 12;
            } elseif ($this->startTimeFormat === 'a.m.' && $this->startHour === 12) {
                $hour24 = 0;
            }

            $administrationTime = sprintf('%02d:%02d:00', $hour24, $this->startMinute);

            $dateData = [
                'start_date' => $this->startDate,
                'end_date' => $this->endDate,
                'administration_time' => $administrationTime,
                'weekdays' => $this->selectedDaysString,
            ];
        }

        if ($this->editItemId) {
            // Actualizar prescripción existente
            $prescription = \App\Models\Prescription::find($this->editItemId);
            if ($prescription && $prescription->doctor_id === Auth::id()) {
                $updateData = [
                    'prescription_item_id' => $prescriptionItem->id,
                    'dose' => $this->dose,
                    'dose_unit' => $this->doseUnit,
                    'observations' => $this->observations,
                ];
                
                // Agregar fechas si existen
                if (!empty($dateData)) {
                    $updateData = array_merge($updateData, $dateData);
                }
                
                $prescription->update($updateData);
                session()->flash('success', 'Cambios guardados correctamente.');
            }
        } else {
            // Crear nueva prescripción
            $prescriptionData = [
                'doctor_id' => Auth::id(),
                'patient_id' => $this->patient->id,
                'prescription_item_id' => $prescriptionItem->id,
                'dose' => $this->dose,
                'dose_unit' => $this->doseUnit,
                'observations' => $this->observations,
            ];
            
            // Agregar fechas si existen
            if (!empty($dateData)) {
                $prescriptionData = array_merge($prescriptionData, $dateData);
            }

            \App\Models\Prescription::create($prescriptionData);
            session()->flash('success', 'Medicamento agregado correctamente.');
        }

        $this->showMedicationModal = false;
        $this->checkAssigned();
    }

    public function deleteItem($id)
    {
        $prescription = \App\Models\Prescription::find($id);
        if ($prescription && $prescription->doctor_id === Auth::id()) {
            $prescription->delete();
            $this->checkAssigned();
        }
    }

    public function confirmDeleteItem($id)
    {
        $this->itemToDelete = $id;
        $this->showDeleteConfirmModal = true;
    }

    public function cancelDeleteItem()
    {
        $this->showDeleteConfirmModal = false;
        $this->itemToDelete = null;
    }

    public function finalizeDeleteItem()
    {
        if ($this->itemToDelete) {
            $this->deleteItem($this->itemToDelete);
            $this->showDeleteConfirmModal = false;
            $this->itemToDelete = null;
            session()->flash('success', 'Medicamento eliminado correctamente.');
        }
    }

    public function getMyPrescriptionItemsProperty()
    {
        return \App\Models\Prescription::where('doctor_id', Auth::id())
            ->where('patient_id', $this->patient->id)
            ->with('medication')
            ->latest()
            ->get();
    }

    public function getAllPrescriptionItemsProperty()
    {
        return \App\Models\Prescription::withTrashed()
            ->with(['medication', 'doctor'])
            ->where('patient_id', $this->patient->id)
            ->latest()
            ->get();
    }

    public function getAgeProperty()
    {
        if (!$this->patient->birth_date) {
            return null;
        }
        return Carbon::parse($this->patient->birth_date)->age;
    }

    private function getAge()
    {
        return $this->age;
    }

    public function toggleTimeFormat()
    {
        $this->isPm = !$this->isPm;
        $this->startTimeFormat = $this->isPm ? 'p.m.' : 'a.m.';
        
        // Aquí puedes disparar una notificación o actualizar la hora
        // que se muestra en tu sistema MedAlert o SmartQueue.
    }

    public function incrementHour()
    {
        $this->startHour = $this->startHour >= 12 ? 1 : $this->startHour + 1;
    }

    public function decrementHour()
    {
        $this->startHour = $this->startHour <= 1 ? 12 : $this->startHour - 1;
    }

    public function toggleWeekday($day)
    {
        $selectedDays = !empty($this->selectedDaysString) 
            ? array_map('trim', explode(',', $this->selectedDaysString)) 
            : [];
        
        $dayKey = array_search($day, $selectedDays);
        
        if ($dayKey !== false) {
            unset($selectedDays[$dayKey]);
        } else {
            $selectedDays[] = $day;
        }
        
        // Ordenar los días en el orden correcto de la semana
        $weekdayOrder = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        usort($selectedDays, function($a, $b) use ($weekdayOrder) {
            return array_search($a, $weekdayOrder) - array_search($b, $weekdayOrder);
        });
        
        $this->selectedDaysString = !empty($selectedDays) ? implode(', ', $selectedDays) : '';
    }

    public function openDatesModal()
    {
        // Si estamos editando una prescripción, cargar sus fechas
        if ($this->editItemId) {
            $prescription = \App\Models\Prescription::find($this->editItemId);
            if ($prescription) {
                $this->currentItemForDates = $prescription->id;
                $this->startDate = $prescription->start_date ? $prescription->start_date->format('Y-m-d') : '';
                $this->endDate = $prescription->end_date ? $prescription->end_date->format('Y-m-d') : '';
                $this->selectedDaysString = $prescription->weekdays ?? '';
                
                // Cargar hora de administración
                if ($prescription->administration_time) {
                    $time = \Carbon\Carbon::parse($prescription->administration_time);
                    $this->startHour = (int) $time->format('h');
                    $this->startMinute = (int) $time->format('i');
                    $this->startTimeFormat = $time->format('A') === 'AM' ? 'a.m.' : 'p.m.';
                    $this->isPm = $time->format('A') === 'PM';
                }
            }
        }

        $this->showDatesModal = true;
    }

    public function saveDates()
    {
        // Limpiar error previo
        $this->pastHourError = null;

        $this->validate([
            'startDate' => 'required|date|after_or_equal:today|before_or_equal:' . date('Y-m-d', strtotime('+3 days')),
            'endDate' => 'required|date|after_or_equal:' . ($this->startDate ?: 'today') . '|before_or_equal:' . date('Y-m-d', strtotime('+1 year')),
            'startHour' => 'required|integer|min:1|max:12',
            'startMinute' => 'required|integer|min:0|max:59',
            'selectedDaysString' => 'required|string',
        ], [
            'startDate.required' => 'La fecha de inicio es obligatoria.',
            'startDate.date' => 'La fecha de inicio debe ser válida.',
            'startDate.after_or_equal' => 'La fecha de inicio no puede ser pasada.',
            'startDate.before_or_equal' => 'La fecha de inicio no puede ser más de 3 días en el futuro.',
            'endDate.required' => 'La fecha de fin es obligatoria.',
            'endDate.date' => 'La fecha de fin debe ser válida.',
            'endDate.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
            'endDate.before_or_equal' => 'La fecha de fin no puede ser más de 1 año en el futuro.',
            'startHour.required' => 'La hora es obligatoria.',
            'startHour.integer' => 'La hora debe ser un número entero.',
            'startHour.min' => 'La hora debe ser entre 1 y 12.',
            'startHour.max' => 'La hora debe ser entre 1 y 12.',
            'selectedDaysString.required' => 'Debes seleccionar al menos un día de la semana.',
        ]);

        // Validar que la hora no sea pasada si se selecciona el día actual (today)
        $selectedDate = Carbon::parse($this->startDate);
        $today = Carbon::now()->startOfDay();
        
        if ($selectedDate->isSameDay($today)) {
            // Convertir hora a formato 24h para comparar
            $hour24 = $this->startHour;
            if ($this->startTimeFormat === 'p.m.' && $this->startHour !== 12) {
                $hour24 = $this->startHour + 12;
            } elseif ($this->startTimeFormat === 'a.m.' && $this->startHour === 12) {
                $hour24 = 0;
            }

            // Crear un objeto DateTime con la hora seleccionada
            $selectedTime = Carbon::now()->setHour($hour24)->setMinute($this->startMinute)->setSecond(0);
            $currentTime = Carbon::now();

            // Si la hora seleccionada es menor que la hora actual, mostrar error
            if ($selectedTime->isBefore($currentTime)) {
                $this->pastHourError = 'No se pueden definir horas pasadas';
                return;
            }
        }

        // Convertir hora a formato 24h
        $hour24 = $this->startHour;
        if ($this->startTimeFormat === 'p.m.' && $this->startHour !== 12) {
            $hour24 = $this->startHour + 12;
        } elseif ($this->startTimeFormat === 'a.m.' && $this->startHour === 12) {
            $hour24 = 0;
        }

        $administrationTime = sprintf('%02d:%02d:00', $hour24, $this->startMinute);

        // Si estamos dentro del modal de fechas individual, simplemente cerramos y las fechas se guardarán con el medicamento
        $this->showDatesModal = false;
        session()->flash('success', 'Fechas configuradas correctamente. Se guardarán cuando guarden el medicamento.');
    }

    public function render()
    {
        return view('livewire.doctors.patient-info');
    }
}
