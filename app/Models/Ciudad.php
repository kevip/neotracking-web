<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = "ciudad";

    public function Provincia(){
        return $this->belongsTo(Provincia::class,'provincia_id');
    }

    public function Distritos(){
        return $this->hasMany(Distrito::class,'ciudad_id');
    }

}
