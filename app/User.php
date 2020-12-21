<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo',
        'documentNumber',
        'name',
        'lastname',
        'phone',
        'email',
        'password',
        
        'direccion',
        'tipo_sangre',
        'tipo_eps',
        'photo'
    ];
    
    /* Mutadores = se utilza para moificar el atributo de un valor
    antes de hacer la insert en la DB 

    Accesores = Son al momento de acceder a los datos estos nos
    regresaran en un formato expecifico dado. 
    */

    public function setNameAttribute($valor)
    {
        $this->attributes['name'] = strtolower($valor);
    }

    public function getNameAttribute($valor)
    {
        /* ucfirst() la letra en mayuscula */
        return ucwords($valor);
    }

    public function setLastnameAttribute($valor)
    {
        $this->attributes['lastname'] = strtolower($valor);
    }

    public function getLastnameAttribute($valor)
    {
        /* ucfirst() la letra en mayuscula */
        return ucwords($valor);
    }

    public function setEmailAttribute($valor)
    {
        $this->attributes['email'] = strtolower($valor);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
