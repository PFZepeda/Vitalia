<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionDose extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'scheduled_at',
        'status',
        'taken_at',
        'missed_at',
        'miss_reason',
        'miss_other',
        'reminder_15_sent_at',
        'reminder_5_sent_at',
        'reminder_late_sent_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'taken_at' => 'datetime',
        'missed_at' => 'datetime',
        'reminder_15_sent_at' => 'datetime',
        'reminder_5_sent_at' => 'datetime',
        'reminder_late_sent_at' => 'datetime',
    ];

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }
}
