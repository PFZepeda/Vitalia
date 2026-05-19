<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrescriptionItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['medication_name'];

    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class);
    }

    public function brands(): HasMany
    {
        return $this->hasMany(MedicationBrand::class);
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(PatientMedicationStock::class);
    }
}
