<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'cuadro_id',
        'numero_turno',
        'estado'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cuadro()
    {
        return $this->belongsTo(Cuadro::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
