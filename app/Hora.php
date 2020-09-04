<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hora extends Model
{

    protected $fillable = [
        'hora_inicio_cita',
        'hora_fin_cita'
    ];
    protected $table = 'horas';
    
    protected $hidden = ['created_at', 'updated_at'];

}
