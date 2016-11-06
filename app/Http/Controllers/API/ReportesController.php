<?php

namespace App\Http\Controllers\API;

use App\Models\Categoria;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Region1;
use App\Models\Region2;
use App\Models\Retail;
use App\Models\Subcategoria1;
use App\Models\Subcategoria2;
use App\Models\Tienda;
use App\Models\TipoStock;
use App\Models\TipoTienda;
use App\Repositories\ReportesRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReportesController extends Controller
{

    protected $reportesRepository;

    public function __construct(ReportesRepository $reportesRepository)
    {
        $this->reportesRepository = $reportesRepository;
    }

    public function getFiltros(){
        $filtros = [];

        $categorias = Categoria::orderBy('tipo')->get();

        $subcategorias1 = Subcategoria1::orderBy('tipo')->get();

        $subcategorias2 = Subcategoria2::orderBy('tipo')->get();

        $departamentos = Departamento::orderBy('nombre')->get();

        $tiendas = Tienda::orderBy('name')->get();

        $region1 = Region1::orderBy('nombre')->get();

        $region2 = Region2::orderBy('nombre')->get();

        $provincias = Provincia::orderBy('nombre')->get();

        $retail = Retail::orderBy('name')->get();

        $tipoTienda = TipoTienda::orderBy('name')->get();

        $filtros = [
            "categorias" => $categorias,
            "subcategorias1" => $subcategorias1,
            "subcategorias2" => $subcategorias2,
            "departamentos" => $departamentos,
            "tiendas" => $tiendas,
            "region1" => $region1,
            "region2" => $region2,
            "provincias" => $provincias,
            "retails" => $retail,
            "tipoTienda" => $tipoTienda
        ];

        return $filtros;
    }

    public function search(Request $request){
        return $this->reportesRepository->search($request);
    }
}
