<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = [
        'title',
        'descripcion',
        'color',
        'remiteEPS',
        'fecha_cita',
        'start',
        'end',
        'user_id',
        'medicoxsede_medico_idmedico',
        'medicoxsede_sede_idsede',
        //'medicoxsede_turno_idturno',
    ];
    protected $table = 'citas';
}
