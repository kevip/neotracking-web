<?php

namespace App\Repositories;

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

        $tienda = Tienda::create([
            'name'     => $request->name,
            'state'        => $request->state
        ]);

        return $tienda;
    }



}