<?php


namespace App\Http\Controllers\API;

use App\Models\Tienda;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\TipoTienda;
use App\Repositories\TiendasRepository;
use Symfony\Component\HttpFoundation\Request;

class TiendasController extends Controller{

    protected $tiendaRepository;


    public function __construct(TiendasRepository $tiendaRepository){
        $this->tiendaRepository = $tiendaRepository;
    }

    public function index(){
        return Tienda::all();
    }

    public function store(Request $request){
        return $this->tiendaRepository->store($request);
    }

    public function getTipo(){
        return TipoTienda::all();
    }

}