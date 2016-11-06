<?php

namespace App\Http\Controllers\API;

use App\Models\Categoria;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoriasController extends Controller
{

    public function index(){
        return Categoria::orderBy('tipo')->get();
    }
}
