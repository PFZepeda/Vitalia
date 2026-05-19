<?php

namespace App\Livewire\Patient;

use App\Models\PrescriptionDose;
use App\Models\MedicationInteraction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Medicamentos extends Component
{
    public $doses;
    public $doseInteractions = [];
    public $showTakeModal = false;
    public $showOmitModal = false;
    public $selectedDoseId = null;
    public $actionTime = null;
    public $omissionReason = '';
    public $omissionOther = '';

    public function mount(): void
    {
        $this->loadDoses();
    }

    public function getSelectedDoseProperty()
    {
        return $this->doses?->firstWhere('id', $this->selectedDoseId);
    }

    public function openTakeModal($doseId): void
    {
        if (! $this->findDoseForAction($doseId)) {
            return;
        }

        $this->resetActionState();
        $this->selectedDoseId = $doseId;
        $this->actionTime = Carbon::now()->toDateTimeString();
        $this->showTakeModal = true;
    }

    public function openOmitModal($doseId): void
    {
        if (! $this->findDoseForAction($doseId)) {
            return;
        }

        $this->resetActionState();
        $this->selectedDoseId = $doseId;
        $this->actionTime = Carbon::now()->toDateTimeString();
        $this->showOmitModal = true;
    }

    public function closeActionModal(): void
    {
        $this->resetActionState();
    }

    public function selectOmissionReason(string $reason): void
    {
        $this->omissionReason = $reason;

        if ($reason !== 'Otro') {
            $this->omissionOther = '';
        }

        $this->resetValidation('omissionReason');
    }

    public function confirmTake(): void
    {
        $dose = $this->findDoseForAction($this->selectedDoseId);
        if (! $dose) {
            return;
        }

        $prescription = $dose->prescription;
        
        // Verificar si el paciente tiene stock suficiente antes de permitir la toma
        if ($prescription && $prescription->prescription_item_id) {
            $stock = \App\Models\PatientMedicationStock::where('patient_id', Auth::id())
                ->where('prescription_item_id', $prescription->prescription_item_id)
                ->first();

            $pillsNeeded = $prescription->pill_count ?? 1;

            if (!$stock || $stock->current_pills < $pillsNeeded) {
                $this->dispatch('swal:error', [
                    'title' => 'Sin stock',
                    'text' => 'No cuentas con suficientes pastillas en stock para confirmar esta toma. Por favor, acude con tu farmacéutico.',
                ]);
                $this->resetActionState();
                return;
            }
        }

        $now = Carbon::now();

        \Illuminate\Support\Facades\DB::transaction(function () use ($dose, $now, $prescription) {
            $dose->update([
                'status' => 'taken',
                'taken_at' => $now,
                'missed_at' => null,
                'miss_reason' => null,
                'miss_other' => null,
            ]);

            $this->updatePrescriptionStatus($dose, 'taken', $now);

            // Restar del stock del paciente
            $stock = \App\Models\PatientMedicationStock::where('patient_id', Auth::id())
                ->where('prescription_item_id', $prescription->prescription_item_id)
                ->first();

            $pillsToSubtract = $prescription->pill_count ?? 1;
            $stock->decrement('current_pills', $pillsToSubtract);

            // Verificar si el stock bajó de 3 unidades para enviar correo
            if ($stock->fresh()->current_pills <= 3) {
                $patient = Auth::user();
                $medication = $prescription->medication;
                $currentStock = $stock->current_pills;

                // Enviar al paciente
                \Illuminate\Support\Facades\Mail::to($patient)->send(
                    new \App\Mail\LowMedicationStockAlert($patient, $medication, $currentStock)
                );

                // Enviar al cuidador asignado si existe
                $assignment = \App\Models\CaregiverRequest::where('patient_id', $patient->id)
                    ->where('status', 'accepted')
                    ->with('caregiver')
                    ->first();
                
                if ($assignment && $assignment->caregiver) {
                    \Illuminate\Support\Facades\Mail::to($assignment->caregiver)->send(
                        new \App\Mail\LowMedicationStockAlert($patient, $medication, $currentStock)
                    );
                }
            }
        });

        $this->resetActionState();
        $this->loadDoses();
    }

    public function confirmOmission(): void
    {
        $dose = $this->findDoseForAction($this->selectedDoseId);
        if (! $dose) {
            return;
        }

        $this->validate([
            'omissionReason' => 'required|string|in:Olvido,Efecto adverso,No tenia medicamento,Otro',
            'omissionOther' => 'nullable|string|max:250',
        ], [
            'omissionReason.required' => 'Selecciona un motivo de omision.',
            'omissionReason.in' => 'Selecciona un motivo valido.',
            'omissionOther.max' => 'El motivo no puede superar 250 caracteres.',
        ]);

        $now = Carbon::now();

        $dose->update([
            'status' => 'missed',
            'missed_at' => $now,
            'miss_reason' => $this->omissionReason,
            'miss_other' => $this->omissionReason === 'Otro' ? $this->omissionOther : null,
            'taken_at' => null,
        ]);

        $this->updatePrescriptionStatus($dose, 'missed', $now);

        $this->resetActionState();
        $this->loadDoses();
    }

    private function resetActionState(): void
    {
        $this->reset(['showTakeModal', 'showOmitModal', 'selectedDoseId', 'actionTime', 'omissionReason', 'omissionOther']);
        $this->resetValidation();
    }

    private function loadDoses(): void
    {
        $now = Carbon::now();
        $todayStart = $now->copy()->startOfDay();
        $todayEnd = $now->copy()->endOfDay();
        $tomorrowMidnight = $now->copy()->addDay()->startOfDay();
        $showThreshold = $now->copy()->addMinutes(15);

        $userId = Auth::id();
        $user = Auth::user();

        // Si es cuidador, ver las dosis del paciente asignado
        if ($user && $user->hasRole(\App\Support\RoleNames::CAREGIVER)) {
            $assignment = \App\Models\CaregiverRequest::where('caregiver_id', $userId)
                ->where('status', 'accepted')
                ->first();
            
            if ($assignment) {
                $userId = $assignment->patient_id;
            } else {
                $this->doses = collect();
                return;
            }
        }

        $this->doses = PrescriptionDose::query()
            ->with(['prescription.medication'])
            ->whereHas('prescription', function ($query) use ($userId) {
                $query->where('patient_id', $userId);
            })
            ->where(function ($query) use ($todayStart, $todayEnd, $tomorrowMidnight) {
                $query->whereBetween('scheduled_at', [$todayStart, $todayEnd])
                    ->orWhere('scheduled_at', $tomorrowMidnight);
            })
            ->where(function ($query) use ($showThreshold) {
                $query->where('status', '!=', 'pending')
                    ->orWhere('scheduled_at', '<=', $showThreshold);
            })
            ->orderBy('scheduled_at')
            ->get();

        $this->detectInteractions();
    }

    private function detectInteractions(): void
    {
        $this->doseInteractions = [];

        if ($this->doses->isEmpty()) {
            return;
        }

        // Agrupar dosis por hora de toma para detectar conflictos
        $dosesByTime = $this->doses->groupBy(function ($dose) {
            return $dose->scheduled_at?->format('Y-m-d H:i') ?? 'sin-hora';
        });

        foreach ($dosesByTime as $time => $dosesAtTime) {
            if ($dosesAtTime->count() < 2) {
                continue;
            }

            $medicationNames = $dosesAtTime->pluck('prescription.medication.medication_name')->unique()->values();

            // Verificar interacciones entre cada par de medicamentos
            for ($i = 0; $i < count($medicationNames); $i++) {
                for ($j = $i + 1; $j < count($medicationNames); $j++) {
                    $med1 = $medicationNames[$i];
                    $med2 = $medicationNames[$j];

                    $interaction = MedicationInteraction::findInteraction($med1, $med2);

                    if ($interaction) {
                        $dosePair = $dosesAtTime->filter(function ($dose) use ($med1, $med2) {
                            $medName = $dose->prescription?->medication?->medication_name;
                            return $medName === $med1 || $medName === $med2;
                        })->values();

                        if ($dosePair->count() === 2) {
                            $this->doseInteractions[] = [
                                'dose_1_id' => $dosePair[0]->id,
                                'dose_2_id' => $dosePair[1]->id,
                                'medication_1' => $dosePair[0]->prescription?->medication?->medication_name,
                                'medication_2' => $dosePair[1]->prescription?->medication?->medication_name,
                                'interaction_message' => $interaction->interaction_message,
                                'severity' => $interaction->severity,
                                'scheduled_at' => $dosePair[0]->scheduled_at,
                            ];
                        }
                    }
                }
            }
        }
    }

    private function findDoseForAction($doseId): ?PrescriptionDose
    {
        if (! $doseId) {
            return null;
        }

        $dose = PrescriptionDose::query()
            ->with('prescription')
            ->whereKey($doseId)
            ->whereHas('prescription', function ($query) {
                $query->where('patient_id', Auth::id());
            })
            ->first();

        if (! $dose || $dose->status !== 'pending') {
            return null;
        }

        if (! $this->isWithinActionWindow($dose, Carbon::now())) {
            return null;
        }

        return $dose;
    }

    private function isWithinActionWindow(PrescriptionDose $dose, Carbon $now): bool
    {
        $start = $dose->scheduled_at->copy()->subMinutes(15);
        $end = $dose->scheduled_at->copy()->addMinutes(30);

        return $now->between($start, $end);
    }

    private function updatePrescriptionStatus(PrescriptionDose $dose, string $status, Carbon $now): void
    {
        if (! $dose->prescription) {
            return;
        }

        if ($status === 'taken') {
            $dose->prescription->update([
                'last_status' => 'taken',
                'last_taken_at' => $now,
                'last_missed_at' => null,
                'last_miss_reason' => null,
                'last_miss_other' => null,
            ]);

            return;
        }

        $dose->prescription->update([
            'last_status' => 'missed',
            'last_taken_at' => null,
            'last_missed_at' => $now,
            'last_miss_reason' => $dose->miss_reason,
            'last_miss_other' => $dose->miss_other,
        ]);
    }

    public function render()
    {
        return view('livewire.patient.medicamentos');
    }
}
