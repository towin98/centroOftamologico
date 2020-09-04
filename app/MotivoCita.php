<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotivoCita extends Model
{
    protected $fillable = [
        'nombreasunto'
    ];
    protected $table = 'motivo_citas';
}
