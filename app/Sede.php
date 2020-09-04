<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $fillable = [
        'nombre',
        'direccion',	
        'telefono',
    ];
    protected $table = 'sedes';
}
