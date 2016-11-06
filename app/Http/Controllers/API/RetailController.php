<?php

namespace App\Http\Controllers\API;

use App\Models\Retail;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RetailController extends Controller
{
    public function index(){
        return Retail::all();
    }
}
