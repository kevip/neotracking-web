<?php

namespace App\Http\Controllers\API;

use App\Models\Track;
use App\Models\TrackStatus;
use App\User;
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
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function index(Request $request)
    {
        $tracks = Track::with(['tienda', 'trackImagen', 'usuario'])->orderBy('created_at', 'asc')->get();

        if(isset($request->page)){
            $page = $request->page;
            $pagination = isset($request->pagination) ? $request->pagination : 20;
            $prev_page = ($page-1 <= 0) ? null : $page-1;
            $next_page = (count($tracks->forPage($page+1,$pagination))) ? $page+1 : null;

            $response = new \StdClass();

            $response->prev_page = $prev_page;
            $response->current_page = intval($page);
            $response->next_page = $next_page;
            $response->data = $tracks->forPage($page,$pagination);
            $response->per_page = $pagination;
            $response->total = count($tracks);
            return collect($response);
        }
        return $tracks;
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

    public function baja(Request $request, $id){
        return $this->trackRepository->baja($request, $id);
    }


}
