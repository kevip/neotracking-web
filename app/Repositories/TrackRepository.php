<?php

namespace App\Repositories;

use Symfony\Component\HttpFoundation\Request;

use App\Models\Track;
use Symfony\Component\HttpFoundation\Response;

class TrackRepository
{


    /**
     * @param $id
     * @return Track
     */
    public function show($id)
    {
        return Track::with(['tienda'])->find($id);
    }

    public function store(Request $request){
        return 1;
    }


}