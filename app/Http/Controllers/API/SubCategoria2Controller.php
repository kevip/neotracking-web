<?php

namespace App\Http\Controllers\API;

use App\Models\Subcategoria2;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SubCategoria2Controller extends Controller
{
    public function index(){
        return Subcategoria2::all();
    }

    public function show($id){
        return Subcategoria2::find($id);
    }

    public function store(Request $request){

    }
}
