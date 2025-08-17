<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public function participante()
    {
        return $this->belongsTo(Participant::class);
    }

    public function comprobantes()
    {
        return $this->hasMany(Comprobante::class);
    }
    protected $fillable = [
        'participante_id',
        'monto',
        'comprobante',
        'descripcion',
        'estado',
        'fecha_pago',
    ];
}
