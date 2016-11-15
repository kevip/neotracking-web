<?php

namespace App\Http\Controllers\API;

use App\Models\Categoria;
use App\Models\Mobiliario;
use App\Models\Subcategoria1;
use App\Models\Subcategoria2;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MobiliarioController extends Controller
{
    public function store(Request $request){

        $m = new Mobiliario;

        $categoria = $request->get('categoria');
        if($categoria){
            if(isset($categoria['id'])){
                $m->categoria_id = $categoria['id'];
            }else{
                $c = Categoria::firstOrCreate([
                    'tipo' => $categoria
                ]);
                $m->categoria_id = $c->id;
            }

        }

        $subcategoria1 = $request->get('subcategoria1');
        if($subcategoria1){
            if(isset($subcategoria1['id'])){
                $m->subcategoria1_id = $subcategoria1['id'];
            }else{
                $sc1 = Subcategoria1::firstOrCreate([
                    'tipo' => $subcategoria1
                ]);
                $m->subcategoria1_id = $sc1->id;
            }

        }

        $subcategoria2 = $request->get('subcategoria2');
        if($subcategoria2){
            if(isset($subcategoria2['id'])){
                $m->subcategoria2_id = $subcategoria2['id'];
            }else{
                $sc2 = Subcategoria2::firstOrCreate([
                    'tipo' => $subcategoria2
                ]);
                $m->subcategoria2_id = $sc2->id;
            }

        }

        $m->save();

    }
}
