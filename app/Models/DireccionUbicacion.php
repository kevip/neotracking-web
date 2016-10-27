<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DireccionUbicacion extends Model
{
    protected $table = 'direccion_ubicacion';

    public function region1(){
        return $this->belongsTo(Region1::class, 'region1_id');
    }

    public function region2(){
        return $this->belongsTo(Region2::class, 'region2_id');
    }

    public function departamento(){
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    public function provincia(){
        return $this->belongsTo(Provincia::class, 'provincia_id');
    }
}
