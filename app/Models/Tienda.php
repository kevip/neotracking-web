<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    protected $table = 'tienda';

    protected $fillable = [
        'channel_id',
        'direccion_ubicacion_id',
        'retail_id',
        'tipo_tienda_id',
        'direccion',
        'name',
        'state'
    ];

    public function direccionUbicacion(){
        return $this->belongsTo(DireccionUbicacion::class, 'direccion_ubicacion_id');
    }

    public function channel(){
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function retail(){
        return $this->belongsTo(Retail::class, 'retail_id');
    }

    public function tipoTienda(){
        return $this->belongsTo(TipoTienda::class, 'tipo_tienda_id');
    }

}
