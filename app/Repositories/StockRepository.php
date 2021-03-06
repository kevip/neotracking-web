<?php

namespace App\Repositories;

use App\Models\Track;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

use App\Models\Stock;
use App\User;

class StockRepository
{
    private $STOCK_STATUS = [
        "alta" =>1,
        "baja" =>2,
        "pendiente_alta"=>3,
        "pendiente_baja"=>4,
        "pendiente_alta_puede_editar"=>5
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

        $query1 = \DB::table("stock");
        $query1 = $query1
            ->join("tienda","tienda.id","=","stock.tienda_id")
            ->join("stock_status","stock_status.id","=","stock.status")
            ->where("stock_status.name", "=", "pendiente_alta")
            ->orWhere("stock_status.name", "=", "pendiente_alta_puede_editar");

        $query1 = $query1->select(
                "stock.id",
                "stock.codigo",
                "tienda.name as tienda",
                "stock_status.name as status"
            )
            ->orderBy('stock_status.name', 'desc');

        if(isset($request->keyword))
            $this->_searchColumn($query1,$request->keyword, 'tienda.name');

        $query1 = $query1->get();

        $query2 = \DB::table("stock");
        $query2 = $query2
            ->join("categoria","categoria.id","=","stock.categoria_id")
            ->join("subcategoria1","subcategoria1.id","=","stock.subcategoria1_id")
            ->join("subcategoria2","subcategoria2.id","=","stock.subcategoria2_id")
            ->join("tienda","tienda.id","=","stock.tienda_id")
            ->join("stock_status","stock_status.id","=","stock.status")
            ->where("stock_status.name", "!=", "baja")
            ->where("stock_status.name", "!=", "pendiente_alta")
            ->where("stock_status.name", "!=", "pendiente_alta_puede_editar");

        if(isset($request->keyword))
            $this->_searchColumn($query2, $request->keyword, 'tienda.name');

        $query2 = $query2->select(
                "stock.id",
                "stock.codigo",
                "categoria.tipo as categoria",
                "subcategoria1.tipo as subcategoria1",
                "subcategoria2.tipo as subcategoria2",
                "tienda.name as tienda",
                "stock_status.name as status"
            )
            ->orderBy('stock_status.name', 'desc');
        $query2 = $query2->get();

        $stock = collect(array_merge($query1, $query2));

        if(isset($request->page)){
            $page = $request->page;
            $pagination = isset($request->pagination) ? $request->pagination : 20;
            $prev_page = ($page-1 <= 0) ? null : $page-1;
            $next_page = (count($stock->forPage($page+1,$pagination))) ? $page+1 : null;

            $response = new \StdClass();

            $response->prev_page = $prev_page;
            $response->current_page = intval($page);
            $response->next_page = $next_page;
            $response->data = $stock->forPage($page,$pagination);
            $response->per_page = $pagination;
            $response->total = count($stock);
            return collect($response);
        }

        return array_merge($query1, $query2);
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'categoria_id' => 'required | integer | min:1',
            'subcategoria1_id' => 'required | integer | min:1',
            'subcategoria2_id' => 'required | integer | min:1',
            'precio'        => 'regex:/^\d*(\.\d{1,2})?$/ | max: 9999999999.99'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 428);
        }
        $stock = Stock::find($id);

        $categoria = $request->categoria_id;
        if(!empty($categoria)){
            $stock->categoria_id = $categoria;
        }

        $subcategoria1 = $request->subcategoria1_id;
        if(!empty($subcategoria1)){
            $stock->subcategoria1_id = $subcategoria1;
        }

        $subcategoria2 = $request->subcategoria2_id;
        if(!empty($subcategoria2)){
            $stock->subcategoria2_id = $subcategoria2;
        }
        $precio = $request->precio;
        if(!empty($precio)){
            $stock->precio = $precio;
        }

        if($stock->status != $this->STOCK_STATUS['pendiente_baja']) {
            $query = \DB::table("track");
            $query = $query
                ->where('track.codigo',$stock->codigo)
                ->where('track_status.name','alta')
                ->join("track_status","track_status.id","=","track.status_id")
                ->join("tienda", "tienda.id", "=", "track.tienda_id")
                ->select("tienda.id")
                ->orderBy('track.created_at','desc');
            $tienda = $query->first();


            $stock->status = $this->STOCK_STATUS['alta'];
            if($tienda) {
                $stock->tienda_id = $tienda->id;
            }
        }
        $stock->save();

        return $stock;
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

    private function _searchColumn(&$query, $keyword, $column){
        $query = $query->where($column, "like", "%" . $keyword . "%");
    }

}