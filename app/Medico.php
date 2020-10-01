<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $fillable = [
        'id_especialidad',
        'id_user',
        'descripcion_perfil',
        'photo',
    ];
    protected $table = 'Medicos';
}

