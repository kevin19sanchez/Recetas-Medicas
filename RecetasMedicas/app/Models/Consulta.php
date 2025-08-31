<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = [
        'paciente_id',
        'medico_id',
        'establecimiento_id',
        'fecha_consulta',
        'motivo_consulta',
        'sintomas',
        'diagnostico',
        'observaciones',
        'presion_arterial',
        'temperatura',
        'peso',
        'proxima_cita',
        'estado'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class);
    }

    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }

}
