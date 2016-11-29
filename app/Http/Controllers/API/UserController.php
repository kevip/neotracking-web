<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\UserRepository;

use App\User;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Return all users except the administrator
     * @return array
     */
    public function index()
    {
        $usrs =  User::with('roles')->where('status','!=','baja')->orderBy('status','desc')->get();
        $users = [];
        //uncomment line bellow to exclude administrators
        /*foreach($usrs->toArray() as $key => $user){
            foreach($user['roles'] as $k => $rol){
                if($rol['name'] !="Administrador"){
                    $users[] = $user;
                }
            }
        }*/
        return $usrs;
    }

    public function show($id)
    {
        return $this->userRepository->find($id);
    }

    public function store(Request $request)
    {
        $this->userRepository->store($request);
    }

    public function update(Request $request, $id)
    {
        return $this->userRepository->update($request, $id);
    }

    /**
     * Alta de usuario
     * @param Request $request
     * @param $id
     * @return User
     */
    public function alta(Request $request, $id)
    {
        return $this->userRepository->alta($request, $id);
    }

    /**
     * Baja de usuario
     * @param Request $request
     * @param $id
     * @return User
     */
    public function baja(Request $request, $id)
    {
        return $this->userRepository->baja($request, $id);
    }


}
