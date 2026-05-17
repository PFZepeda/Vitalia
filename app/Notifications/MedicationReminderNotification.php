<?php

namespace App\Notifications;

use App\Models\PrescriptionDose;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MedicationReminderNotification extends Notification
{
    use Queueable;

    public function __construct(private PrescriptionDose $dose, private string $type)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $prescription = $this->dose->prescription;
        $medicationName = $prescription?->medication?->medication_name ?? 'Medicamento';
        $doseLabel = $prescription?->dose !== null && $prescription?->dose_unit
            ? ($prescription->dose + 0) . ' ' . $prescription->dose_unit
            : 'Dosis no especificada';
        $pillCount = $prescription?->pill_count ? $prescription->pill_count . ' pastilla(s)' : 'Pastillas no especificadas';
        $frequency = $prescription?->frequency_hours ? 'Cada ' . $prescription->frequency_hours . ' horas' : 'Sin frecuencia';
        $scheduledAt = $this->dose->scheduled_at?->format('h:i a') ?? 'hora programada';

        $subject = match ($this->type) {
            'reminder_15' => 'Recordatorio: toma en 15 minutos',
            'reminder_5' => 'Recordatorio: toma en 5 minutos',
            'late' => 'Toma retrasada',
            default => 'Recordatorio de toma',
        };

        $message = match ($this->type) {
            'late' => 'Tu toma ya esta retrasada. Por favor registrala lo antes posible.',
            default => 'Recuerda registrar tu toma en Vitalia.',
        };

        return (new MailMessage)
            ->subject($subject)
            ->greeting('Hola ' . ($notifiable->name ?? ''))
            ->line('Medicamento: ' . $medicationName)
            ->line('Dosis: ' . $doseLabel)
            ->line('Pastillas: ' . $pillCount)
            ->line('Frecuencia: ' . $frequency)
            ->line('Hora programada: ' . $scheduledAt)
            ->line($message);
    }
}
