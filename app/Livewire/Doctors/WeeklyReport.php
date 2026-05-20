<?php

namespace App\Livewire\Doctors;

use App\Models\User;
use App\Models\PrescriptionDose;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class WeeklyReport extends Component
{
    public User $patient;
    public $reportDate;
    public $stats = [];

    public function mount(User $patient, $date)
    {
        $this->patient = $patient;
        $this->reportDate = Carbon::parse($date);
        $this->calculateStats();
    }

    private function calculateStats()
    {
        $end = $this->reportDate->copy()->endOfDay();
        $start = $this->reportDate->copy()->subDays(6)->startOfDay();

        $doses = PrescriptionDose::whereHas('prescription', function ($q) {
            $q->where('patient_id', $this->patient->id);
        })
        ->whereBetween('scheduled_at', [$start, $end])
        ->get();

        $total = $doses->count();
        $taken = $doses->where('status', 'taken')->count();
        $missed = $doses->where('status', 'missed')->count();

        $reasons = [
            'Olvido' => $doses->where('miss_reason', 'Olvido')->count(),
            'Efecto adverso' => $doses->where('miss_reason', 'Efecto adverso')->count(),
            'No tenia medicamento' => $doses->where('miss_reason', 'No tenia medicamento')->count(),
            'Otro' => $doses->where('miss_reason', 'Otro')->count(),
        ];

        $this->stats = [
            'period' => $start->format('d/m/Y') . ' - ' . $end->format('d/m/Y'),
            'total' => $total,
            'taken' => $taken,
            'taken_percentage' => $total > 0 ? round(($taken / $total) * 100) : 0,
            'missed' => $missed,
            'missed_percentage' => $total > 0 ? round(($missed / $total) * 100) : 0,
            'reasons' => $reasons,
            'reasons_percentages' => collect($reasons)->map(fn($val) => $missed > 0 ? round(($val / $missed) * 100) : 0),
        ];
    }

    public function render()
    {
        return view('livewire.doctors.weekly-report');
    }

    public function downloadPdf()
    {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.weekly-report', [
            'patient' => $this->patient,
            'stats' => $this->stats,
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'reporte-semanal-' . $this->patient->name . '-' . $this->reportDate->format('Y-m-d') . '.pdf');
    }
}
