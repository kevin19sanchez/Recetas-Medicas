<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paciente extends Model
{

    protected $table = 'pacientes';

    protected $fillable = [
        'name',
        'last_name',
        'age',
        'dui',
        'date_birth',
        'phone',
        'address'
    ];

    public function home(): BelongsTo
    {
        return $this->belongsTo(Home::class, 'home_id');
    }

    public function consultas(){
        return $this->hasMany(Consulta::class);
    }
}
