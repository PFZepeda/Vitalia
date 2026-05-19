<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicationBrand extends Model
{
    protected $fillable = [
        'prescription_item_id',
        'brand_name',
        'dose',
        'dose_unit',
        'pills_per_box',
        'is_suggested',
    ];

    public function prescriptionItem(): BelongsTo
    {
        return $this->belongsTo(PrescriptionItem::class);
    }
}
