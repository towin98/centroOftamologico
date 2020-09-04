<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $fillable = [
        'nombres',
        'apellidos',
        'id_especialidad',
        'descripcion_perfil',
        'photo',
    ];
    protected $table = 'Medicos';
}

