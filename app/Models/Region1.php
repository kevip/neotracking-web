<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region1 extends Model
{
    protected $table="region1";

    public function region2(){
        return $this->hasMany(Region2::class,'region1_id');
    }

}
