<?php

namespace App\Console\Commands;

use App\Mail\LowMedicationStockAlert;
use App\Models\CaregiverRequest;
use App\Models\PatientMedicationStock;
use App\Models\Prescription;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ProcessLowMedicationStockAlerts extends Command
{
    protected $signature = 'medications:low-stock-alerts';
    protected $description = 'Send daily low stock alerts for active prescriptions.';

    public function handle(): int
    {
        $today = Carbon::today();
        $now = Carbon::now();

        $stocks = PatientMedicationStock::query()
            ->with(['patient', 'prescriptionItem'])
            ->where('current_pills', '<=', 5)
            ->where(function ($query) use ($today) {
                $query->whereNull('last_low_stock_alert_at')
                    ->orWhereDate('last_low_stock_alert_at', '<', $today);
            })
            ->get();

        /** @var \App\Models\PatientMedicationStock $stock */
        foreach ($stocks as $stock) {
            if ($stock->hasLowStockAlertToday()) {
                continue;
            }

            $patient = $stock->patient;
            if (! $patient) {
                continue;
            }

            $prescription = Prescription::query()
                ->where('patient_id', $stock->patient_id)
                ->where('prescription_item_id', $stock->prescription_item_id)
                ->whereNotNull('start_date')
                ->whereNotNull('end_date')
                ->whereDate('start_date', '<=', $today)
                ->whereDate('end_date', '>=', $today)
                ->latest('end_date')
                ->with('medication')
                ->first();

            if (! $prescription) {
                continue;
            }

            $medication = $prescription->medication ?? $stock->prescriptionItem;
            if (! $medication) {
                continue;
            }

            $currentStock = (int) $stock->current_pills;

            Mail::to($patient)->send(
                new LowMedicationStockAlert($patient, $medication, $currentStock)
            );

            $assignment = CaregiverRequest::query()
                ->where('patient_id', $patient->id)
                ->where('status', 'accepted')
                ->with('caregiver')
                ->first();

            if ($assignment && $assignment->caregiver) {
                Mail::to($assignment->caregiver)->send(
                    new LowMedicationStockAlert($patient, $medication, $currentStock)
                );
            }

            $stock->last_low_stock_alert_at = $now;
            $stock->save();
        }

        return self::SUCCESS;
    }
}
