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

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function index(){
        return User::all();
    }

    public function show($id){
        return $this->userRepository->find($id);
    }
    public function store(Request $request){

    }
    public function update(Request $request){

    }


}
