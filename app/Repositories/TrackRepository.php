<?php

namespace App\Repositories;

use App\Models\Tienda;
use App\Models\TrackImagen;
use App\User;
use Symfony\Component\HttpFoundation\Request;

use App\Models\Track;
use Symfony\Component\HttpFoundation\Response;

class TrackRepository
{

    private $TRACKING_STATUS = [
        "Alta" =>1,
        "Baja" =>2,
        "Pendiente"=>3
    ];

    public function baja(Request $request, $id){
        return $this->cambiarEstado($this->TRACKING_STATUS["Baja"], $id);
    }

    /**
     * @param $status
     * @param $id
     * @return mixed
     */
    private function cambiarEstado($status, $id){
        $user_id = \Auth::user()->id;
        $user = User::with('roles')->find($user_id);
        $authorized = false;
        $track = Track::find($id);
        if (!is_null($user)) {
            foreach ($user->roles as $key => $role) {
                if ($role->name == "Administrador") {
                    $authorized = true;
                }
            }
            if($authorized){
                $track->status = $status;
                $track->save();
            }
        }

        return $track;
    }
    /**
     * @param $id
     * @return Track
     */
    public function show($id)
    {
        return Track::with(['tienda', 'trackImagen'])->find($id);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {

        $tienda = 1;
        if($request->get('tienda')!=null){
            $tienda = $request->get('tienda');
        }

        $m = new Track();
        $m->codigo = $request->get('codigo');
        $m->tienda_id = $tienda;
        $m->obs  = $request->get('obs');
        $m->lat  = $request->get('lat');
        $m->flag = $request->get('flag');
        $m->guid = $request->get('guid');
        $m->lng  = $request->get('lng');
        $m->num  = $request->get('num');
        $m->usr  = $request->get('usr');
        $m->save();

        if($request->file('photo1') != null) {
            $request->file('photo1')->getClientOriginalName();
            $imageName = $m->id. '_1_' . $request->file('photo1')->getClientOriginalName()//.'.' .$request->file('photo')->getClientOriginalExtension()
            ;
            $request->file('photo1')->move(
                base_path() . '/public/images/', $imageName
            );

            $photo1 = $this->regPhoto($m->id, $request->file('photo1'), $imageName);

        }
        if($request->file('photo2') != null) {
            $request->file('photo2')->getClientOriginalName();
            $imageName = $m->id . '_2_' . $request->file('photo2')->getClientOriginalName()//.'.' .$request->file('photo')->getClientOriginalExtension()
            ;
            $request->file('photo2')->move(
                base_path() . '/public/images/', $imageName
            );

            $photo2 = $this->regPhoto($m->id, $request->file('photo2'), $imageName);

        }
        if($request->file('photo3') != null) {
            $request->file('photo3')->getClientOriginalName();
            $imageName = $m->id . '_3_' . $request->file('photo3')->getClientOriginalName()//.'.' .$request->file('photo')->getClientOriginalExtension()
            ;
            $request->file('photo3')->move(
                base_path() . '/public/images/', $imageName
            );

            $photo3 = $this->regPhoto($m->id, $request->file('photo3'), $imageName);
        }
        if($request->file('photo4') != null) {
            $request->file('photo4')->getClientOriginalName();
            $imageName = $m->id . '_4_' . $request->file('photo4')->getClientOriginalName()//.'.' .$request->file('photo')->getClientOriginalExtension()
            ;
            $request->file('photo4')->move(
                base_path() . '/public/images/', $imageName
            );

            $photo4 = $this->regPhoto($m->id, $request->file('photo4'), $imageName);
        }
        //$this->em->detach($m);
        return response()->json(array('code' => $m->codigo));
    }

    /**
     * @param $track_id
     * @param $file
     * @param $imageName
     * @return TrackImagen
     */
    private function regPhoto($track_id, $file, $imageName){
        $img = new TrackImagen();
        $img->track_id = $track_id;

        $tipo = $file->getClientOriginalExtension();
        $img->type = $tipo;

        $name = $file->getClientOriginalName();
        $img->name = $name;

        $img->url = 'http://www.neoprojects.com.pe/neotracking-web/public/images/' . $imageName;

        $img->save();
        return $img;
    }


}