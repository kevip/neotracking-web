<?php

namespace App\Http\Controllers\API;

use App\Models\Departamento;
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
        return Region1::all();
    }

    public function getRegion2(){
        return Region2::all();
    }

    public function getProvincias(){
        return Provincia::all();
    }

    public function getDepartamentos(){
        return Departamento::all();
    }
}
