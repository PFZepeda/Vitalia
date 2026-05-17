<?php

namespace App\Console\Commands;

use App\Models\Prescription;
use App\Models\PrescriptionDose;
use App\Notifications\MedicationReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProcessMedicationReminders extends Command
{
    protected $signature = 'medications:process-reminders';
    protected $description = 'Generate doses, send reminders, and auto-mark missed intakes.';

    public function handle(): int
    {
        $now = Carbon::now();

        $this->generateDoses($now);
        $this->sendReminders($now);
        $this->autoMarkMissed($now);

        return self::SUCCESS;
    }

    private function generateDoses(Carbon $now): void
    {
        $windowStart = $now->copy()->startOfDay();
        $windowEnd = $now->copy()->addDay()->endOfDay();

        /** @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\Prescription> $prescriptions */
        $prescriptions = Prescription::query()
            ->with('patient')
            ->whereNotNull('start_date')
            ->whereNotNull('end_date')
            ->whereNotNull('administration_time')
            ->whereNotNull('frequency_hours')
            ->whereDate('end_date', '>=', $windowStart->toDateString())
            ->get();

        foreach ($prescriptions as $prescription) {
            $firstDose = $this->getFirstDoseDateTime($prescription);
            if (! $firstDose) {
                continue;
            }

            $endAt = Carbon::parse($prescription->end_date)->endOfDay();
            if ($firstDose->gt($endAt)) {
                continue;
            }

            $intervalHours = max(1, (int) $prescription->frequency_hours);
            $cursor = $firstDose->copy();

            if ($cursor->lt($windowStart)) {
                $diffHours = $cursor->diffInHours($windowStart, false);
                if ($diffHours > 0) {
                    $steps = intdiv($diffHours, $intervalHours);
                    $cursor->addHours($steps * $intervalHours);
                    if ($cursor->lt($windowStart)) {
                        $cursor->addHours($intervalHours);
                    }
                }
            }

            while ($cursor->lte($windowEnd) && $cursor->lte($endAt)) {
                if ($this->isAllowedWeekday($prescription, $cursor)) {
                    $this->createDoseIfMissing($prescription, $cursor);
                }

                $cursor->addHours($intervalHours);
            }
        }
    }

    private function sendReminders(Carbon $now): void
    {
        $windowStart = $now->copy()->subDay();
        $windowEnd = $now->copy()->addDay();

        /** @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrescriptionDose> $doses */
        $doses = PrescriptionDose::query()
            ->with(['prescription.patient', 'prescription.medication'])
            ->where('status', 'pending')
            ->whereBetween('scheduled_at', [$windowStart, $windowEnd])
            ->get();

        foreach ($doses as $dose) {
            $scheduledAt = $dose->scheduled_at;
            if (! $scheduledAt) {
                continue;
            }

            $reminder15At = $scheduledAt->copy()->subMinutes(15);
            $reminder5At = $scheduledAt->copy()->subMinutes(5);
            $lateAt = $scheduledAt->copy()->addMinutes(10);

            if (! $dose->reminder_15_sent_at && $now->greaterThanOrEqualTo($reminder15At) && $now->lt($reminder5At)) {
                $this->notifyPatient($dose, 'reminder_15');
                $dose->reminder_15_sent_at = $now;
            }

            if (! $dose->reminder_5_sent_at && $now->greaterThanOrEqualTo($reminder5At) && $now->lt($scheduledAt)) {
                $this->notifyPatient($dose, 'reminder_5');
                $dose->reminder_5_sent_at = $now;
            }

            if (! $dose->reminder_late_sent_at && $now->greaterThanOrEqualTo($lateAt)) {
                $this->notifyPatient($dose, 'late');
                $dose->reminder_late_sent_at = $now;
            }

            if ($dose->isDirty(['reminder_15_sent_at', 'reminder_5_sent_at', 'reminder_late_sent_at'])) {
                $dose->save();
            }
        }
    }

    private function autoMarkMissed(Carbon $now): void
    {
        $missThreshold = $now->copy()->subMinutes(30);

        /** @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrescriptionDose> $doses */
        $doses = PrescriptionDose::query()
            ->with('prescription')
            ->where('status', 'pending')
            ->where('scheduled_at', '<=', $missThreshold)
            ->get();

        foreach ($doses as $dose) {
            $dose->update([
                'status' => 'missed',
                'missed_at' => $now,
                'miss_reason' => 'Olvido',
                'miss_other' => null,
            ]);

            if ($dose->prescription) {
                $dose->prescription->update([
                    'last_status' => 'missed',
                    'last_missed_at' => $now,
                    'last_miss_reason' => 'Olvido',
                    'last_miss_other' => null,
                    'last_taken_at' => null,
                ]);
            }
        }
    }

    private function notifyPatient(PrescriptionDose $dose, string $type): void
    {
        $patient = $dose->prescription?->patient;
        if (! $patient) {
            return;
        }

        $patient->notify(new MedicationReminderNotification($dose, $type));
    }

    private function getFirstDoseDateTime(Prescription $prescription): ?Carbon
    {
        if (! $prescription->start_date || ! $prescription->administration_time) {
            return null;
        }

        $date = Carbon::parse($prescription->start_date)->format('Y-m-d');
        $time = Carbon::parse($prescription->administration_time)->format('H:i:s');

        return Carbon::createFromFormat('Y-m-d H:i:s', $date . ' ' . $time);
    }

    private function createDoseIfMissing(Prescription $prescription, Carbon $scheduledAt): void
    {
        PrescriptionDose::query()->firstOrCreate([
            'prescription_id' => $prescription->id,
            'scheduled_at' => $scheduledAt,
        ], [
            'status' => 'pending',
        ]);
    }

    private function isAllowedWeekday(Prescription $prescription, Carbon $date): bool
    {
        if (! $prescription->weekdays) {
            return true;
        }

        $selected = array_filter(array_map('trim', explode(',', $prescription->weekdays)));
        if (empty($selected)) {
            return true;
        }

        $weekdayMap = [
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miercoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado',
            7 => 'Domingo',
        ];

        $dayName = $weekdayMap[$date->dayOfWeekIso] ?? null;
        if (! $dayName) {
            return false;
        }

        $normalizedSelected = array_map([$this, 'normalizeWeekday'], $selected);
        $normalizedDay = $this->normalizeWeekday($dayName);

        return in_array($normalizedDay, $normalizedSelected, true);
    }

    private function normalizeWeekday(string $day): string
    {
        $day = trim($day);
        $day = function_exists('mb_strtolower') ? mb_strtolower($day) : strtolower($day);

        return str_replace(
            ['á', 'é', 'í', 'ó', 'ú', 'ü'],
            ['a', 'e', 'i', 'o', 'u', 'u'],
            $day
        );
    }
}
