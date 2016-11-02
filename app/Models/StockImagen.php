<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockImagen extends Model
{
    protected $table = 'stock_imagen';

    protected $fillable =[
        'stock_id',
        'url',
        'name',
        'type'
    ];
    public function track(){
        return $this->belongsTo(Stock::class, 'stock_id');
    }


}
