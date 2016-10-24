<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $table = 'track';

    public function tienda(){
        return $this->belongsTo(Tienda::class, 'tienda_id');
    }

}
