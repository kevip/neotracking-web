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

        return Stock::with([
            'stockImagen',
            'categoria',
            'subcategoria1',
            'subcategoria2',
            'ubicacion.direccionUbicacion.region1',
            'ubicacion.direccionUbicacion.region2',
            'ubicacion.direccionUbicacion.departamento',
            'ubicacion.direccionUbicacion.provincia',
            'tipoStock',
            'tienda'

        ])->get();
    }

    public function search(Request $request){
        return $this->stockRepository->search($request);
    }
    public function store(Request $request)
    {
        return $this->stockRepository->search($request);
    }

    public function show($id)
    {
        return Stock::with([
            'stockImagen',
            'categoria',
            'subcategoria1',
            'subcategoria2',
            'ubicacion'

        ])->find($id);
    }

    public function getHistory($codigo){
        //return Stock::with(['tracking']);
        return Track::with(['tienda', 'trackImagen'])->where('codigo',$codigo)->get();
    }
}
