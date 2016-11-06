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
