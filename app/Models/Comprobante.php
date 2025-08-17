<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_id',
        'archivo',
        'tipo'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
