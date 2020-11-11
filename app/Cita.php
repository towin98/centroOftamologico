<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cita extends Model
{
    use SoftDeletes;

    const DELETED_AT = 'asistio';

    protected $fillable = [
        'title',
        'id_medico',
        'descripcion',
        'color',
        'remiteEPS',
        'fecha_cita',
        'consultorio',
        'start',
        'end',
        'user_id',
        'orden',
    
    ];
    
    protected $table = 'citas';
}
