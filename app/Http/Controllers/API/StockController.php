<?php

namespace App\Http\Controllers\API;

use App\Models\TipoStock;
use App\Models\Track;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\StockRepository;
use App\Models\Stock;
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

    public function getHistory($codigo){
        //return Stock::with(['tracking']);
        return Track::with(['tienda', 'trackImagen', 'usuario', 'status'])->where('codigo',$codigo)->orderBy('created_at','desc')->get();
    }
}
