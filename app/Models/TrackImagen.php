<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackImagen extends Model
{
    protected $table = 'track_imagen';

    protected $fillable = [
        'track_id',
        'url',
        'name',
        'type'
    ];
    public function track(){
        return $this->belongsTo(Track::class, 'track_id');
    }
}
