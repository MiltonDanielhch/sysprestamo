<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $casts = [
        'fecha_cancelado' => 'datetime', // Para Laravel 8+
    ];
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    public function prestamo(){
        return $this->belongsTo(Prestamo::class);
    }
}
