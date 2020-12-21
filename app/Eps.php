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

    public function setNombreAttribute($valor)
    {
        $this->attributes['nombre'] = strtolower($valor);
    }

    public function getNombreAttribute($valor)
    {
        return ucfirst($valor); /* la letra en mayuscula */
    }
}
