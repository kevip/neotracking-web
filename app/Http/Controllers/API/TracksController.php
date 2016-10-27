<?php

namespace App\Http\Controllers\API;

use App\Models\Track;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\TrackRepository;

class TracksController extends Controller
{
    protected $trackRepository;


    public function __construct(TrackRepository $trackRepository){
        $this->trackRepository = $trackRepository;
    }

    /**
     * @return Track
     */
    public function index(){
        return Track::with(['tienda', 'trackImagen'])->get();
    }

    /**
     * @param $id
     * @return Track
     */
    public function show($id){
        return $this->trackRepository->show($id);
    }

    public function store(Request $request){
        return $this->trackRepository->store($request);
    }


}
