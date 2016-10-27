<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $table = 'track';

    protected $fillable = [
        'tienda_id',
        'codigo',
        'obs',
        'lat',
        'lng',
        'num',
        'usr',
        'dtime',
        'status',
    ];

    public function tienda(){
        return $this->belongsTo(Tienda::class, 'tienda_id');
    }

    public function trackImagen(){
        return $this->hasMany(TrackImagen::class, 'track_id');

    }

}
