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

    public function index()
    {
        return User::with('roles')->get();
    }

    public function show($id)
    {
        return $this->userRepository->find($id);
    }

    public function store(Request $request)
    {
        $this->userRepository->store($request);
    }

    public function update(Request $request)
    {

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
