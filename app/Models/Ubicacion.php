<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'ubicacion';
    protected $fillable = [
        'direccion_ubicacion_id',
        'tipo'
    ];
    public function direccionUbicacion(){
        return $this->belongsTo(DireccionUbicacion::class, 'direccion_ubicacion_id');
    }
}
