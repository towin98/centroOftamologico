<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class especialidad extends Model
{
    protected $fillable = [
        'name'
    ];
    protected $table = 'especialidads';
    
    protected $hidden = ['created_at', 'updated_at'];
}
