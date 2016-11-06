<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $table = "distrito";

    public function ciudad(){
        return $this->belongsTo(Ciudad::class,'ciudad_id');
    }

}
