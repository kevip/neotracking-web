<?php

namespace App\Repositories;

use Symfony\Component\HttpFoundation\Request;
use App\Models\Stock;
use App\User;

class ReportesRepository {


    public function search(Request $request){

        $query = \DB::table("stock");

        if($request->has('categoria') && sizeof($request->get('categoria'))>0 ){
            $id_categoria = [];
            foreach($request->get('categoria') as $key => $categoria){
                $id_categoria[] = $categoria['id'];
            }
            $query = $query->whereIN("stock.categoria_id",$id_categoria );
        }

        if($request->has('subcategoria1') && sizeof($request->get('subcategoria1'))>0){
            $id_subcategoria1 = [];
            foreach($request->get('subcategoria1') as $key => $subcategoria1){
                $id_subcategoria1[] = $subcategoria1['id'];
            }
            $query = $query->whereIN("stock.subcategoria1_id",$id_subcategoria1 );

        }

        if($request->has('subcategoria2') && sizeof($request->get('subcategoria2'))>0){
            $id_subcategoria2 = [];
            foreach($request->get('subcategoria2') as $key => $subcategoria2){
                $id_subcategoria2[] = $subcategoria2['id'];
            }
            $query = $query->whereIN("stock.subcategoria2_id",$id_subcategoria2 );
        }

        if($request->has('region1') && sizeof($request->get('region1'))>0){
            $id_region1 = [];
            foreach($request->get('region1') as $key => $region1){
                $id_region1[] = $region1['id'];
            }
            $query->whereIN("direccion_ubicacion.region1_id",$id_region1 );
        }

        if($request->has('region2') && sizeof($request->get('region2'))>0){
            $id_region2 = [];
            foreach($request->get('region2') as $key => $region2){
                $id_region2[] = $region2['id'];
            }
            $query->whereIN("direccion_ubicacion.region2_id",$id_region2 );
        }

        if($request->has('departamento') && sizeof($request->get('departamento'))>0){
            $id_departamento = [];
            foreach($request->get('departamento') as $key => $departamento){
                $id_departamento[] = $departamento['id'];
            }
            $query->whereIN("direccion_ubicacion.departamento_id",$id_departamento );
        }

        if($request->has('provincia') && sizeof($request->get('provincia'))>0){
            $id_provincia = [];
            foreach($request->get('provincia') as $key => $provincia){
                $id_provincia[] = $provincia['id'];
            }
            $query->whereIN("direccion_ubicacion.provincia_id",$id_provincia );
        }

        if($request->has('tipoTienda') && sizeof($request->get('tipoTienda'))>0){
            $id_tipo_tienda = [];
            foreach($request->get('tipoTienda') as $key => $tipo_tienda){
                $id_tipo_tienda[] = $tipo_tienda['id'];
            }
            $query->whereIN("tienda.tipo_tienda_id",$id_tipo_tienda );
        }

        if($request->has('tiendas') && sizeof($request->get('tiendas'))>0){
            $id_tienda = [];
            foreach($request->get('tiendas') as $key => $tienda){
                $id_tienda[] = $tienda['id'];
            }
            $query->whereIN("stock.tienda_id",$id_tienda );
        }

        $query = $query->join("tienda","tienda.id","=","stock.tienda_id")
            ->join("direccion_ubicacion","direccion_ubicacion.id","=","tienda.direccion_ubicacion_id")
            ->join("provincia","provincia.id","=","direccion_ubicacion.provincia_id")
            ->join("departamento","departamento.id","=","direccion_ubicacion.departamento_id")
            ->join("region1","region1.id","=","direccion_ubicacion.region1_id")
            ->join("region2","region2.id","=","direccion_ubicacion.region2_id")
            ->select("stock.id");

        $stocks = $query->get();

        $id_stock = [];
        foreach($stocks as $key => $value){
            $id_stock[] = $value->id;
        }

        return Stock::with([
            'stockImagen',
            'categoria',
            'subcategoria1',
            'subcategoria2',
            'tienda.direccionUbicacion.region1',
            'tienda.direccionUbicacion.region2',
            'tienda.direccionUbicacion.departamento',
            'tienda.direccionUbicacion.provincia',
            'tienda',
            'tienda.tipoTienda'

        ])->findMany($id_stock);
    }

}