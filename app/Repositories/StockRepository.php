<?php

namespace App\Repositories;

use Symfony\Component\HttpFoundation\Request;

use App\Models\Stock;
use App\User;

class StockRepository
{
    private $STOCK_STATUS = [
        "alta" =>1,
        "baja" =>2,
        "pendiente"=>3
    ];

    public function baja(Request $request, $codigo){
        return $this->cambiarEstado($this->STOCK_STATUS["baja"], $codigo);
    }


    public function store(Request $request){
        $validator = \Validator::make($request->all(), [
            'codigo' => 'required|unique:stock',
            'cantidad' =>'required|numeric',
            'subcategoria1' =>'required',
            'subcategoria2' =>'required',
            'categoria' =>'required',
            'tipo_stock' =>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 428);
        }

        $stock = new Stock();
        $stock->codigo = $request->codigo;
        $stock->subcategoria1_id = $request->subcategoria1;
        $stock->subcategoria2_id = $request->subcategoria2;
        $stock->categoria_id = $request->categoria;
        $stock->tipo_stock = $request->tipo_stock;
        $stock->cantidad = $request->cantidad;
        $stock->status = $this->STOCK_STATUS['pendiente'];
        $stock->save();
        return $stock;
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

    private function cambiarEstado($status, $codigo){
        $user_id = \Auth::user()->id;
        $user = User::with('roles')->find($user_id);
        $authorized = false;
        $stock = Stock::where('codigo',$codigo)->first();
        if (!is_null($user)) {
            foreach ($user->roles as $key => $role) {
                if ($role->name == "Administrador") {
                    $authorized = true;
                }
            }
            if($authorized){
                $stock->status = $status;
                $stock->save();
            }
        }

        return $stock;
    }

}