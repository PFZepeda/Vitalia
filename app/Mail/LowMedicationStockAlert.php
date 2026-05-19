<?php

namespace App\Mail;

use App\Models\User;
use App\Models\PrescriptionItem;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LowMedicationStockAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $patient;
    public $medication;
    public $currentStock;

    /**
     * Create a new message instance.
     */
    public function __construct(User $patient, PrescriptionItem $medication, int $currentStock)
    {
        $this->patient = $patient;
        $this->medication = $medication;
        $this->currentStock = $currentStock;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '¡Alerta de Stock Bajo! - Vitalia',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.medication-low-stock',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
