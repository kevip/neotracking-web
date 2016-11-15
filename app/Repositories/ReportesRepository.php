<?php

namespace App\Repositories;

use App\Models\Track;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Stock;
use App\User;

class ReportesRepository {

    /**
     * Retorna un array con los ultimos tracks de cada codigo encontrado
     * @param Request $request
     * @return array
     */
    public function getCodigos(Request $request){
        $query = \DB::table("stock");

        if($request->categoria){
            $query = $query->where("categoria.tipo",$request->categoria);
        }
        if($request->subcategoria1){
            $query = $query->where("subcategoria1.tipo",$request->subcategoria1);
        }
        if($request->subcategoria2){
            $query = $query->where("subcategoria2.tipo",$request->subcategoria2);
        }
        if($request->tienda){
            $query = $query->where("tienda.name",$request->tienda);
        }
        if($request->tipo_tienda){
            $query = $query->where("tipo_tienda.name",$request->tipo_tienda);
        }
        if($request->departamento){
            $query = $query->where("departamento.nombre",$request->departamento);
        }
        if($request->provincia){
            $query = $query->where("provincia.nombre",$request->provincia);
        }
        if($request->region1){
            $query = $query->where("region1.nombre",$request->region1);
        }
        if($request->region2){
            $query = $query->where("region2.nombre",$request->region2);
        }
        if($request->retail){
            $query = $query->where("retail.name",$request->retail);
        }

        $query = $query->join("tienda","tienda.id","=","stock.tienda_id")
            ->join("retail","retail.id","=","tienda.retail_id")
            ->join("tipo_tienda","tipo_tienda.id","=","tienda.tipo_tienda_id")
            ->join("direccion_ubicacion","direccion_ubicacion.id","=","tienda.direccion_ubicacion_id")
            ->join("provincia","provincia.id","=","direccion_ubicacion.provincia_id")
            ->join("departamento","departamento.id","=","direccion_ubicacion.departamento_id")
            ->join("region1","region1.id","=","direccion_ubicacion.region1_id")
            ->join("region2","region2.id","=","direccion_ubicacion.region2_id")
            ->join("categoria","categoria.id","=","stock.categoria_id")
            ->join("subcategoria1","subcategoria1.id","=","stock.subcategoria1_id")
            ->join("subcategoria2","subcategoria2.id","=","stock.subcategoria2_id")
            ->join("stock_status","stock_status.id","=","stock.status")
            ->where("stock_status.name", "=", "alta")
            ->orWhere("stock_status.name", "=", "pendiente_baja")
            ->select(
                "stock.codigo"
            );

        $results = $query->get();
        $codigos = [];
        foreach($results as $key => $result){
            $codigos[] = $result->codigo;
        }
        $tracks  = Track::with(['tienda', 'trackImagen', 'usuario', 'status'])->whereIN('codigo',$codigos)->orderBy('created_at','desc')->get();
        $trck = [];
        foreach ($tracks as $key => $track) {
            if(sizeof($trck)==0){
                $trck[] = $track;
            }
            else if(sizeof($trck)>0 ){
                $add = true;
                foreach($trck as $t){
                    if($t['codigo'] == $track['codigo']){
                        $add = false;
                    }
                }
                if($add){
                    $trck[] = $track;
                }
            }
        }
        return $trck;
    }

    public function search(Request $request){
        $all = $request->all();
        $empty = true;
        $arr = [];
        foreach($all as $k => $v){
            if(!empty($v))
                $empty = false;

        }
        if($empty)
            return [];

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
        if($request->has('retail') && sizeof($request->get('retail'))>0){
            $id_retail = [];
            foreach($request->get('retail') as $key => $retail){
                $id_retail[] = $retail['id'];
            }
            $query->whereIN("tienda.retail_id",$id_retail );
        }

        $query = $query->join("tienda","tienda.id","=","stock.tienda_id")
            ->join("retail","retail.id","=","tienda.retail_id")
            ->join("tipo_tienda","tipo_tienda.id","=","tienda.tipo_tienda_id")
            ->join("direccion_ubicacion","direccion_ubicacion.id","=","tienda.direccion_ubicacion_id")
            ->join("provincia","provincia.id","=","direccion_ubicacion.provincia_id")
            ->join("departamento","departamento.id","=","direccion_ubicacion.departamento_id")
            ->join("region1","region1.id","=","direccion_ubicacion.region1_id")
            ->join("region2","region2.id","=","direccion_ubicacion.region2_id")
            ->join("categoria","categoria.id","=","stock.categoria_id")
            ->join("subcategoria1","subcategoria1.id","=","stock.subcategoria1_id")
            ->join("subcategoria2","subcategoria2.id","=","stock.subcategoria2_id")
            ->join("stock_status","stock_status.id","=","stock.status")
            ->where("stock_status.name", "=", "alta")
            ->orWhere("stock_status.name", "=", "pendiente_baja")
            ->select(
                "categoria.tipo as categoria",
                "subcategoria1.tipo as subcategoria1",
                "subcategoria2.tipo as subcategoria2",
                "region1.nombre as region1",
                "region2.nombre as region2",
                "departamento.nombre as departamento",
                "provincia.nombre as provincia",
                "tienda.name as tienda",
                "tipo_tienda.name as tipo_tienda",
                "retail.name as retail",
                \DB::raw('count(stock.id) as cantidad'))
            ->groupBy(
                'categoria',
                'subcategoria1',
                'subcategoria2',
                'region1',
                'region2',
                'departamento',
                'provincia',
                'tienda',
                'tipo_tienda'
            );

        $stocks = $query->get();
        return $stocks;
    }

}