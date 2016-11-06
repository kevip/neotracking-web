<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\Stock;
use App\Models\StockStatus;
use App\Models\Track;
use App\Models\TrackStatus;
use Symfony\Component\HttpFoundation\Request;

use App\User;

class UserRepository
{

    private $USER_STATUS = [
        "activo"      => 1,
        "pendiente"    => 2,
        "baja"       => 3
    ];

    /**
     * @param Request $request
     * @param $id
     * @return User
     */
    public function alta(Request $request, $id)
    {
        $tracks = Track::with('status')
            ->where('usr',$id)
            ->get();
        $track_status_alta = TrackStatus::where('name', 'alta')->first();
        $codigos = [];

        foreach ($tracks as $key => $track) {
            if($track['status']['name'] == 'pendiente'){
                $t = Track::find($track['id']);
                $t->status_id = $track_status_alta->id;
                $t->save();
            }
            if(sizeof($codigos)>0 && !in_array($track['codigo'], $codigos)){
                $codigos[] = $track['codigo'];
            }else
                $codigos[] = $track['codigo'];
        }
        $stock_status_alta = StockStatus::where('name', 'pendiente_alta_puede_editar')->first();
        foreach ($codigos as $key => $codigo) {
            $s = Stock::with('stockStatus')->where('codigo',$codigo)->first();
            $s_a = $s->toArray();
            if($s_a['stock_status']['name'] =='pendiente_alta'){
                $trk = Track::where('status_id',$track_status_alta->id)->orderBy('created_at','desc')->first();
                $s->status = $stock_status_alta->id;
                $s->tienda_id = $trk->tienda_id;
                $s->save();
            }
        }
        return $this->cambiarEstado($this->USER_STATUS["activo"], $id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return User
     */
    public function baja(Request $request, $id)
    {
        return $this->cambiarEstado($this->USER_STATUS["baja"], $id);
    }

    /**
     * @param $id
     * @return User
     */
    public function find($id)
    {
        return User::with('roles')->find($id);
    }

    /**
     * @param Request $request
     * @return User
     */
    public function store(Request $request)
    {
        /*$validator = \Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 428);
        }*/
        $user = User::create(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => $request->password
            ]
        );
        //$this->syncRoles($request, $user);
        $user->roles()->attach($request->rol);
        return User::with('roles')->find($user->id);
    }

    /**
     * @param $status
     * @param $id
     * @return User
     */
    private function cambiarEstado($status, $id){
        $user_id = \Auth::user()->id;
        $user = User::with('roles')->find($user_id);
        $authorized = false;
        $usr = User::find($id);
        if (!is_null($user)) {
            foreach ($user->roles as $key => $role) {
                if ($role->name == "Administrador") {
                    $authorized = true;
                }
            }
            if($authorized){
                $usr->status = $status;
                $usr->save();
            }
        }

        return $usr;
    }

    /**
     * @param Request $request
     * @param User $user
     */
    private function syncRoles(Request $request, User $user)
    {
        $user->roles()->sync(collect($request->roles)->pluck('id')->all());
    }

    public function update($request, $id){
        $user = User::find($id);
        /*$validator = \Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 428);
        }*/
        if ($request->email){
            $user->email    = $request->email;
        }
        $user->first_name   = $request->first_name;
        $user->last_name    = $request->last_name;
        $user->save();
        if(!empty($request->rol)){
            foreach($user->roles as $key => $rol){
                $user->roles()->detach($rol->id);
            }
            $user->roles()->attach($request->rol);
        }
        $this->verifyNameOnTracks($user);
        return User::find($user->id);
    }

    private function verifyNameOnTracks(User $user){
        $tracks = Track::where('usr', $user->id)->get();

        foreach($tracks->all() as $key => $track){
            if($track['user_first_name'] == "" || $track['user_last_name'] == ""){
                $t = Track::find($track['id']);
                $t->user_first_name = $user->first_name;
                $t->user_last_name = $user->last_name;
                $t->save();
            }
        }
    }


}