<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion'
    ];
    protected $table = 'consultorios';
    
    public function setNombreAttribute($valor)
    {
        $this->attributes['nombre'] = strtolower($valor);
    }

    public function getNombreAttribute($valor)
    {
        /* ucfirst() la letra en mayuscula */
        return ucwords($valor);
    }

    //protected $hidden = ['created_at', 'updated_at'];
}
