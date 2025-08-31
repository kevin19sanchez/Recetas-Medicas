<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = ['name', 'description'];

    public function medicamento()
    {
        return $this->hasMany(Medicamento::class, 'category_id');
    }
}
