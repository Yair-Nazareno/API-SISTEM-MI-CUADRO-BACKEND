<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;
    protected $fillable = [
        'participante_id',
        'monto',
        'estado',
        'fecha_pago'
    ];

    public function participante()
    {
        return $this->belongsTo(Participant::class);
    }

    public function comprobantes()
    {
        return $this->hasMany(Comprobante::class);
    }
}
