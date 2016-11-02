<?php

namespace App\Repositories;

use App\Models\Role;
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
        $user->email        = $request->email;
        $user->first_name   = $request->first_name;
        $user->last_name    = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->save();
        if(!empty($request->rol)){
            foreach($user->roles as $key => $rol){
                $user->roles()->detach($rol->id);
            }
            $user->roles()->attach($request->rol);
        }
        return User::find($user->id);
    }


}