<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table = "provincia";

    public function departamento(){
        return $this->belongsTo(Departamento::class,'provincia_id');
    }

    public function ciudades(){
        return $this->hasMany(Ciudad::class,'provincia_id');
    }
}
