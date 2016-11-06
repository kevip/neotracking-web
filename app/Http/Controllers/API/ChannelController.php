<?php

namespace App\Http\Controllers\API;

use App\Models\Channel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ChannelController extends Controller
{
    public function index(){
        return Channel::all();
    }
}
