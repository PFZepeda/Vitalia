<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prescription extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['doctor_id', 'patient_id', 'prescription_item_id', 'dose', 'dose_unit', 'observations', 'start_date', 'end_date', 'administration_time', 'weekdays'];
    
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'administration_time' => 'datetime:H:i:s',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function medication()
    {
        return $this->belongsTo(PrescriptionItem::class, 'prescription_item_id');
    }
}
