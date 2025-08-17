<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuadro extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'monto_individual',
        'total_participantes',
        'frecuencia_pago',
        'duracion',
        'duracion_dias',
        'fondo_respaldo',
        'organizador_id',
        'activo',
    ];

    protected  $Hidden = [
        'id'
    ];
    public function organizador()
    {
        return $this->belongsTo(User::class, 'organizador_id');
    }

    public function participantes()
    {
        return $this->hasMany(Participant::class);
    }

    public function invitados()
    {
        return $this->hasMany(Invitation::class);
    }
}
