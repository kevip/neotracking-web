<?php

namespace App\Repositories;

use App\Models\Stock;
use App\Models\Tienda;
use App\Models\TrackImagen;
use App\Models\Role;

use App\Models\TrackStatus;
use App\User;
use Symfony\Component\HttpFoundation\Request;

use App\Models\Track;
use App\Models\StockStatus;

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
     * @param $codigo
     * @return Stock
     */
    private function createStockOnTrack($codigo, $tienda){

        $status_pendiente = StockStatus::where('name','=','pendiente_alta')->first();
        $stock = new Stock();
        $stock->codigo = $codigo;
        $stock->tienda_id = $tienda;
        $stock->status = $status_pendiente->id;
        $stock->save();
        return $stock;
    }

    /**
     * @param $phone_number
     * @return User
     */
    private function createUserOnTrack($phone_number){
        $user = User::create([
            "phone_number" => $phone_number
        ]);
        $rol = Role::where('name','Supervisor')->first();
        $user->roles()->attach($rol->id);

        return User::find($user->id);
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
        if($request->get('tienda')!=null) {
            $tienda = $request->get('tienda');
        }

        $codigo = $request->get('codigo');
        $stock = Stock::where('codigo', $codigo)->first();
        if(empty($stock)) {
            $stck = $this->createStockOnTrack($codigo, $tienda);
        }else{
            if($request->get('flag')=='Baja'){
                $this->sugerirBaja($stock);
            }
        }

        $phone_number = $request->get('num');
        $usr = User::where('phone_number', $phone_number)->first();
        if(empty($usr)) {
            $usr = $this->createUserOnTrack($phone_number);
        }

        $m = new Track();
        $m->codigo = $codigo;
        $m->tienda_id = $tienda;
        $m->obs  = $request->get('obs');
        $m->lat  = $request->get('lat');
        $m->flag = $request->get('flag');
        $m->guid = $request->get('guid');
        $m->lng  = $request->get('lng');
        $m->num  = $request->get('num');
        $m->usr  = $usr->id;

        if($usr->first_name){
            $m->user_first_name = $usr->first_name;
        }
        if($usr->last_name){
            $m->user_last_name = $usr->last_name;
        }
        if($usr['status'] =='pendiente') {
            $t_status = TrackStatus::where('name', 'pendiente')->first();
        }
        else
            $t_status = TrackStatus::where('name','alta')->first();

        $m->status_id = $t_status->id;
        $m->save();

        $this->cambiarTiendaMobiliario($m->codigo);

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

        $img->url = 'http://lg.neoprojects.com.pe/images/' . $imageName;
        //$img->url = base_path() . '/public/images/' . $imageName;

        $img->save();
        return $img;
    }

    private function sugerirBaja(Stock $stock){
        $status_pendiente = StockStatus::where('name','=','pendiente_baja')->first();
        $stock->status = $status_pendiente->id;
        $stock->save();
    }

    private function cambiarTiendaMobiliario($codigo){
        $stock = Stock::with(['stockStatus'])->where('codigo',$codigo)->first();
        $s = $stock->toArray();
        $track_status_alta = TrackStatus::where('name', 'alta')->first();
        if($s['stock_status']['name']=='alta'){
            $trk = Track::where('status_id',$track_status_alta->id)->orderBy('created_at','desc')->first();
            $stock->tienda_id = $trk->tienda_id;
            $stock->save();
            //return "entré";
        }
    }

}