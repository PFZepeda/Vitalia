<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientMedicationStock extends Model
{
    protected $table = 'patient_medication_stock';

    protected $fillable = [
        'patient_id',
        'prescription_item_id',
        'current_pills',
        'last_low_stock_alert_at',
    ];

    protected $casts = [
        'last_low_stock_alert_at' => 'datetime',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function prescriptionItem(): BelongsTo
    {
        return $this->belongsTo(PrescriptionItem::class);
    }

    public function hasLowStockAlertToday(): bool
    {
        return (bool) ($this->last_low_stock_alert_at?->isToday());
    }
}
