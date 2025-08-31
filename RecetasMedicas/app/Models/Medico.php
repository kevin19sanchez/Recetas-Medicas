<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medicos';

    protected $fillable = [
        'code',
        'name',
        'specialty',
        'phone',
        'email',
        'establecimiento_id'
    ];

    public function home(): BelongsTo
    {
        return $this->belongsTo(Home::class, 'home_id');
    }

    public function establecimiento(){
        return $this->belongsTo(Establecimiento::class, 'establecimiento_id'); // Nombre de la columna actualizado
    }

    public function consultas(){
        return $this->hasMany(Consulta::class);
    }

}
