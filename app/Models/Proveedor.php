<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Proveedor extends Model
{
    protected $table = "proveedores";

    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'ruc',
        'created_at',
        'updated_at'
    ];
}