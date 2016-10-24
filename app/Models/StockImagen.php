<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockImagen extends Model
{
    protected $table = 'stock';

    public function track(){
        return $this->belongsTo(Stock::class, 'stock_id');
    }


}
