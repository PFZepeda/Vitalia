<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;

class PrescriptionItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['prescription_id', 'medication_name', 'dose', 'dose_unit', 'frequency', 'observations'];

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }
}
