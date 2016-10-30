<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stock';

    protected $fillable = [
        'cantidad',
        'categoria_id',
        'codigo',
        'descripcion',
        'fecha',
        'imagen',
        'observacion',
        'subcategoria1_id',
        'subcategoria2_id',
        'status',
        'tienda_id',
        'tipo_stock',
        'ubicacion_id'
    ];

    public function stockImagen(){
        return $this->hasMany(StockImagen::class, 'stock_id');

    }

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'categoria_id');

    }

    public function subcategoria1(){
        return $this->belongsTo(Subcategoria1::class, 'subcategoria1_id');

    }

    public function subcategoria2(){
        return $this->belongsTo(Subcategoria2::class, 'subcategoria2_id');

    }

    public function ubicacion(){
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id');

    }

    public function tienda(){
        return $this->belongsTo(Tienda::class, 'tienda_id');

    }

    public function tipoStock(){
        return $this->belongsTo(TipoStock::class, 'tipo_stock');

    }

    public function tracking(){
        return $this->hasMany(Track::class, 'codigo');
    }

}
