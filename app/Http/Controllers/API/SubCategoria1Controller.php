<?php

namespace App\Http\Controllers\API;

use App\Models\Subcategoria1;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SubCategoria1Controller extends Controller
{

    public function index(){
        return Subcategoria1::orderBy('tipo')->get();
    }

    public function show($id){
        return Subcategoria1::find($id);
    }

    public function store(Request $request){

    }

    public function a(){

    }
}
