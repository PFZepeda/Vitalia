<?php

namespace App\Livewire\Patient;

use App\Models\PrescriptionDose;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Medicamentos extends Component
{
    public $doses;
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
                \Illuminate\Support\Facades\Mail::to(Auth::user())->send(
                    new \App\Mail\LowMedicationStockAlert(Auth::user(), $prescription->medication, $stock->current_pills)
                );
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

        $this->doses = PrescriptionDose::query()
            ->with(['prescription.medication'])
            ->whereHas('prescription', function ($query) {
                $query->where('patient_id', Auth::id());
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
