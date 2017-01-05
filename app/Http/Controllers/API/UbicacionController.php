<?php

namespace App\Http\Controllers\API;

use App\Models\Ciudad;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Provincia;
use App\Models\Region1;
use App\Models\Region2;
use App\Models\Ubicacion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use phpDocumentor\Reflection\Types\Resource;

class UbicacionController extends Controller
{
    public function index(){
        return Ubicacion::all();
    }

    public function getRegion1(){
        return Region1::with('region2')->orderBy('nombre')->get();
    }

    public function getRegion2(){
        return Region2::with('departamentos')->orderBy('nombre')->get();
    }

    /**
     * Lista de region2 por cada region1
     * @param Request $request
     * @return mixed
     */
    public function getRegion2ByRegion1(Request $request){

        return Region2::where('region1_id', $request->region1_id)->get();
    }

    /**
     * Lista de departamentos por cada region2
     * @param Request $request
     * @return mixed
     */
    public function getDepartamentosByRegion2(Request $request){

        return Departamento::where('region2_id', $request->region2_id)->get();
    }

    /**
     * Lista de provincias por cada departamento
     * @param Request $request
     * @return mixed
     */
    public function getProvinciasByDepartamento(Request $request){

        return Provincia::where('departamento_id', $request->departamento_id)->get();
    }

    /**
     * Lista de ciudades por cada provincia
     * @param Request $request
     * @return mixed
     */
    public function getCiudadesByProvincia(Request $request){

        return Ciudad::where('provincia_id', $request->provincia_id)->get();
    }

    /**
     * Lista de distritos por cada ciudad
     * @param Request $request
     * @return mixed
     */
    public function getDistritosByCiudad(Request $request){

        return Distrito::where('ciudad_id', $request->ciudad_id)->get();
    }

    public function getProvincias(){
        return Provincia::with('ciudades')->orderBy('nombre')->get();
    }

    public function getDepartamentos(){
        return Departamento::with('provincias')->orderBy('nombre')->get();
    }

    public function getDistrito(){
        return Distrito::orderBy('name')->get();
    }

    public function getCiudad(){
        return Ciudad::with('distritos')->orderBy('name')->get();
    }
}
