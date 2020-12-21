<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotivoCita extends Model
{
    protected $fillable = [
        'nombreasunto',
        'duracionCita'
    ];
    protected $table = 'motivo_citas';
}
