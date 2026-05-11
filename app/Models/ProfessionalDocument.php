<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ProfessionalDocument extends Model
{
    use HasFactory;

    protected $table = 'professional_documents';

    protected $fillable = [
        'user_id',
        'path',
        'specialty',
        'status',
        'reason',
    ];

    public const STATUS_PENDING = 'pendiente';
    public const STATUS_ACCEPTED = 'aceptado';
    public const STATUS_REJECTED = 'rechazado';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
