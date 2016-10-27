<?php

namespace App\Repositories;

use Symfony\Component\HttpFoundation\Request;

use App\User;

class UserRepository
{

    private $USER_STATUS = [
        "accepted"      => 1,
        "registered"    => 2,
        "removed"       => 3
    ];

    /**
     * @param Request $request
     * @param $id
     * @return User
     */
    public function alta(Request $request, $id)
    {
        return $this->cambiarEstado($this->USER_STATUS["accepted"], $id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return User
     */
    public function baja(Request $request, $id)
    {
        return $this->cambiarEstado($this->USER_STATUS["removed"], $id);
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
        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 428);
        }
        $user = User::create(
            [
                'username' => $request->username,
                'email' => $request->email,
                'password' => \Hash::make($request->password),
            ]
        );
        $this->syncRoles($request, $user);
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


}