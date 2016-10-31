<?php

namespace App\Http\Controllers\API;

use App\Models\Categoria;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Region1;
use App\Models\Region2;
use App\Models\Subcategoria1;
use App\Models\Subcategoria2;
use App\Models\Tienda;
use App\Models\TipoStock;
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

        $categorias = Categoria::all();

        $subcategorias1 = Subcategoria1::all();

        $subcategorias2 = Subcategoria2::all();

        $departamentos = Departamento::all();

        $tiendas = Tienda::all();

        $region1 = Region1::all();

        $region2 = Region2::all();

        $provincias = Provincia::all();

        $tipoStock = TipoStock::all();

        $filtros = [
            "categorias" => $categorias,
            "subcategorias1" => $subcategorias1,
            "subcategorias2" => $subcategorias2,
            "departamentos" => $departamentos,
            "tiendas" => $tiendas,
            "region1" => $region1,
            "region2" => $region2,
            "provincias" => $provincias,
            "tipoStock" => $tipoStock
        ];

        return $filtros;
    }

    public function search(Request $request){
        return $this->reportesRepository->search($request);
    }
}
