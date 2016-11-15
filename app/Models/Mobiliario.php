<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobiliario extends Model
{
    protected $table = "mobiliario";

    protected $fillable = [
      'categoria_id',
      'subcategoria1_id',
      'subcategoria2_id',
    ];
}
