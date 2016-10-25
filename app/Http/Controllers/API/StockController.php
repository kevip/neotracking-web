<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\StockRepository;
use App\Models\Stock;

class StockController extends Controller
{
    protected $stockRepository;

    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    public function index()
    {
        return Stock::with([
            'stockImagen',
            'categoria',
            'subcategoria1',
            'subcategoria2',
            'ubicacion'

        ])->get();
    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        return Stock::with([
            'stockImagen',
            'categoria',
            'subcategoria1',
            'subcategoria2',
            'ubicacion'

        ])->find($id);
    }
}
