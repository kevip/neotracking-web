<?php

namespace App\Http\Controllers\API;

use App\Models\Movimiento;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MovementsController extends Controller
{


    public function index(){
        return Movimiento::all();
    }
}
