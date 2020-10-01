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
    
    //protected $hidden = ['created_at', 'updated_at'];
}
