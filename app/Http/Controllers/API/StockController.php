<?php

namespace App\Http\Controllers\API;

use App\Models\TipoStock;
use App\Models\Track;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\StockRepository;
use App\Models\Stock;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    protected $stockRepository;

    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    public function baja(Request $request, $id){
        return $this->stockRepository->baja($request, $id);
    }

    public function getTipo(){
        return TipoStock::all();
    }

    public function index()
    {
        return $this->stockRepository->index();

    }

    /**
     * create new record of stock
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function store(Request $request)
    {
        return $this->stockRepository->store($request);
    }


    public function show($id)
    {
        return Stock::with([
            'categoria',
            'subcategoria1',
            'subcategoria2',
            'stockStatus'
        ])->find($id);
    }

    public function update(Request $request, $id){
        return $this->stockRepository->update($request, $id);
    }

    public function getLastTrack($codigo){
        return Track::with(['trackImagen', 'status'])->where('codigo',$codigo)->orderBy('created_at','desc')->first();
    }

    public function getHistory($codigo){
        //return Stock::with(['tracking']);
        return Track::with(['tienda', 'trackImagen', 'usuario', 'status'])->where('codigo',$codigo)->orderBy('created_at','desc')->get();
    }

    /**
     * Muestra array con la cantidades de stocks clasificadonlos por sus estados:
     * alta, baja, pendiente_alta, pendiente_baja, pendiente_alta_puede_editar
     */
    public function getRegistros(){
        $collection = new Collection();

        $stock = \DB::table("stock")
            ->join("stock_status","stock_status.id","=","stock.status")
            ->select("stock_status.name as status")->get();

        $collection->put('alta',0);
        $collection->put('baja',0);
        $collection->put('pendiente_alta',0);
        $collection->put('pendiente_baja',0);
        $collection->put('pendiente_alta_puede_editar',0);

        foreach($stock as $key =>$value) {
            if ($value->status == 'alta')
                $collection->put('alta', $collection->get('alta') + 1);
            else if ($value->status == 'baja')
                $collection->put('baja', $collection->get('baja') + 1);
            else if ($value->status == 'pendiente_alta')
                $collection->put('pendiente_alta', $collection->get('pendiente_alta') + 1);
            else if ($value->status == 'pendiente_baja')
                $collection->put('pendiente_baja', $collection->get('pendiente_baja') + 1);
            else if ($value->status == 'pendiente_alta_puede_editar')
                $collection->put('pendiente_alta_puede_editar', $collection->get('pendiente_alta_puede_editar') + 1);
        }
        return $collection;
    }
}
