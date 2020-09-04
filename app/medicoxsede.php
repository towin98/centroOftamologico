<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class medicoxsede extends Model
{
    protected $fillable = [
        'medico_id',
        'sede_id',
        'turno_id',
    ];
    protected $table = 'medicoxsedes';
    
    protected $hidden = ['created_at', 'updated_at'];
}
