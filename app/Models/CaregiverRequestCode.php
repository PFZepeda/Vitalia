<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaregiverRequestCode extends Model
{
    protected $fillable = [
        'caregiver_id',
        'patient_id',
        'email',
        'code_hash',
        'expires_at',
        'last_sent_at',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'last_sent_at' => 'datetime',
        ];
    }
}