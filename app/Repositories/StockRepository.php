<?php

namespace App\Repositories;

use Symfony\Component\HttpFoundation\Request;

use App\Models\Stock;

class StockRepository
{


    /**
     * @param $id
     * @return Stock
     */
    public function find($id)
    {
        return Stock::with('roles')->find($id);
    }


}