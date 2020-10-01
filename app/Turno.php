<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $fillable = [
        'id_medico',
        'nombre',
        'dia_turno',
        'hora_inicio',
        'hora_fin',
        'id_consultorio',
    ];
    protected $table = 'turnos';

}
