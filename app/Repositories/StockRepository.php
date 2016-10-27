<?php

namespace App\Repositories;

use Symfony\Component\HttpFoundation\Request;

use App\Models\Stock;

class StockRepository
{

    public function search(Request $request){
        $query = \DB::table("stock");

        if($request->has('categoria')){
            foreach($request->get('categoria') as $key => $categoria){
                $query = $query->where("total_bookings.arrest_date", ">", $now);
            }
        }

        if($request->has('subcategoria')){
            dd($request->get('subcategoria'));
            $query->whereIN("stock.subcategoria1_id", [1,6]);
            /*foreach($request->get('subcategoria') as $key => $categoria){
            }*/
        }

        if($request->has('region')){

        }

        if($request->has('region2')){

        }

        if($request->has('departamento')){

        }

        if($request->has('provincia')){

        }
        return $query->get();
        return Stock::with([
            'stockImagen',
            'categoria',
            'subcategoria1',
            'subcategoria2',
            'ubicacion.direccionUbicacion'

        ])->get();
    }
    public function index(Request $request){


    }
    /**
     * @param $id
     * @return Stock
     */
    public function find($id)
    {
        return Stock::with('roles')->find($id);
    }


}