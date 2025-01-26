<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'guard_name', // Agrega este campo si lo usas, por ejemplo, con Spatie/Permission
    ];
}
