<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eps extends Model
{
    protected $fillable = [
        'nombre',
        'id_tipo_eps'
    ];
    protected $table = 'eps';
}
