<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = "departamento";


    public function region2(){
        return $this->belongsTo(Region2::class,'region2_id');
    }
    public function provincias(){
        return $this->hasMany(Provincia::class,'departamento_id');
    }
}
