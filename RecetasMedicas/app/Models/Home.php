<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Home extends Authenticatable
{

    protected $table = 'homes';

    protected $fillable = [
        'name',
        'email',
        'password',
        'license_number',
        'admin_secret',
        'role',
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'role' => 'string',
        'password' => 'hashed'
    ];

    /*public function casts(){
        return [
            'password' => 'hashed',
        ];
    }*/

    public function medico(): HasOne
    {
        return $this->hasOne(Medico::class, 'home_id');
    }

    public function paciente(): HasOne
    {
        return $this->hasOne(Paciente::class, 'home_id');
    }

    // Mutador para encriptar la contraseña automáticamente
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = Hash::make($value);
    // }
}
