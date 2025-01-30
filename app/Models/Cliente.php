<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nro_documento', 'nombres', 'apellidos', 'fecha_nacimiento', 'genero', 'email', 'celular', 'ref_celular'
    ];

    public function prestamos(){
        return $this->hasMany(Prestamo::class);
    }
}
