<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motivo_citas_has__especialidad extends Model
{
    protected $fillable = [
        'MOTIVO_CITAS_id',
        'ESPECIALIDADS_id',
        'MEDICOS_id'
    ];
    protected $table = 'motivo_citas_has__especialidads';
    
}
