<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = [
        'title',
        'id_medico',
        'descripcion',
        'color',
        'remiteEPS',
        'fecha_cita',
        'start',
        'end',
        'user_id',
        'orden',
    ];
    protected $table = 'citas';
}
