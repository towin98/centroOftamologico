<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $fillable = [
        'id_user',
        'nombre',
        'dia_turno',
        'hora_inicio',
        'hora_fin',
        'Noconsultorio',
    ];
    protected $table = 'turnos';

}
