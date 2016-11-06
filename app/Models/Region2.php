<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region2 extends Model
{
    protected $table ="region2";

    public function region1(){
        return $this->belongsTo(Region1::class,'region1_id');
    }
    public function departamentos(){
        return $this->hasMany(Departamento::class,'region2_id');
    }

}
