<?php

namespace App\Repositories;

use App\Models\DireccionUbicacion;
use App\Models\Ubicacion;
use Symfony\Component\HttpFoundation\Request;

use App\Models\Tienda;

class TiendasRepository {

    /**
     * @param $id
     * @return Tienda
     */
    public function find($id){
        return Tienda::find($id);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request){

        $u = $request->ubicacion;
        $ub = DireccionUbicacion::create([
           'distrito_id' => $u['distrito_id'],
           'ciudad_id' => $u['ciudad_id'],
           'region1_id'  => $u['region1'],
           'region2_id'  => $u['region2'],
           'provincia_id' => $u['provincia_id'],
           'departamento_id' => $u['departamento_id']
        ]);

        $tienda = Tienda::create([
            'channel_id' => $request->channel_id,
            'retail_id' => $request->retail_id,
            'tipo_tienda_id'  => $request->tipo_tienda_id,
            'direccion'  =>  $request->direccion,
            'name' => strtoupper($request->name),
            'direccion_ubicacion_id' => $ub->id
        ]);

        return $tienda->id;
    }



}