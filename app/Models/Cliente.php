<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nro_documento', 'nombres', 'apellidos', 'fecha_nacimiento', 'genero', 'email', 'celular', 'ref_celular'
    ];
}
