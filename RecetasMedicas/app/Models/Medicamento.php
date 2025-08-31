<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{

    protected $table = 'medicamentos';

    protected $fillable = [
        'name',
        'description',
        'price',
        'stocks',
        'category_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'category_id');
    }
}
