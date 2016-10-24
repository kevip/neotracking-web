<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stock';

    protected $fillable = [
        'fecha',
        'imagen',
        'descripcion',
        'observacion',
        'cantidad',
        'categoria_id',
        'subcategoria1_id',
        'subcategoria2_id',
        'ubicacion_id'
    ];
}
