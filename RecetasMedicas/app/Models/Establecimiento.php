<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{


    protected $table = 'establecimientos';

    protected $fillable = [
        'name', 'address', 'phone', 'email', 'code','imagen'
    ];

    public function medicos(){
        return $this->hasMany(Medico::class, 'establecimiento_id'); // Nombre de la columna actualizado
    }

    public function consultas(){
        return $this->hasMany(Consulta::class);
    }

}
