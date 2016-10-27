<?php

namespace App\Repositories;

use App\Models\Tienda;
use Symfony\Component\HttpFoundation\Request;

use App\Models\Track;
use Symfony\Component\HttpFoundation\Response;

class TrackRepository
{


    /**
     * @param $id
     * @return Track
     */
    public function show($id)
    {
        return Track::with(['tienda'])->find($id);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request){

        $track = new Track();
        $tienda_id = $request->get('tienda_id');
        if(!$tienda_id) {
            $tienda = Tienda::first();
            $track->tienda_id = $tienda->id;
        }

        $track->fill($request->all());
        $track->save();

        /*
        if($request->file('photo') != null){
            Log::debug('Se ha subido una imagen ');
            $request->file('photo')->getClientOriginalName();
            $imageName = $m->getId() . '_'.$request->file('photo')->getClientOriginalName()
                //.'.' .$request->file('photo')->getClientOriginalExtension()
            ;
            $request->file('photo')->move(
                base_path() . '/public/images/', $imageName
            );
        }*/
        return response()->json(array('obs' => $track->obs));

    }


}