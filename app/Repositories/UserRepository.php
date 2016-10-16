<?php

namespace App\Repositories;

use Symfony\Component\HttpFoundation\Request;

use App\User;

class UserRepository {


    public function find($id){
        return User::with('roles')->find($id);
    }
    public function store(Request $request){
        $validator = \Validator::make($request->all(), [
            'username'  => 'required|max:255',
            'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required|min:6|confirmed',
            'status'    => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 428);
        }

        $user = User::create(
            [
                'username'     => $request->username,
                'email'        => $request->email,
                'signature'    => $request->signature,
                'password'     => \Hash::make($request->password),
                'badge_number' => $request->badge_number,
                'enabled'      => true,
            ]
        );
        $this->syncRoles($request, $user);

        return User::with('roles')->find($user->id);
    }
    private function syncRoles (Request $request, User $user) {
        $user->roles()->sync(collect($request->roles)->pluck('id')->all());
    }

}