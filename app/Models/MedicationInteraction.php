<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicationInteraction extends Model
{
    protected $fillable = [
        'medication_name_1',
        'medication_name_2',
        'interaction_message',
        'severity',
    ];

    public static function findInteraction(string $med1, string $med2): ?self
    {
        return self::where(function ($query) use ($med1, $med2) {
            $query->where('medication_name_1', $med1)
                  ->where('medication_name_2', $med2);
        })->orWhere(function ($query) use ($med1, $med2) {
            $query->where('medication_name_1', $med2)
                  ->where('medication_name_2', $med1);
        })->first();
    }
}
