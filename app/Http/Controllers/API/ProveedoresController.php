<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ProveedoresRepository;

class ProveedoresController extends Controller
{
    protected $proveedoresRepository;

    public function __construct(ProveedoresRepository $proveedoresRepository)
    {
        $this->proveedoresRepository = $proveedoresRepository;
    }

    /**
     * Display list of 'proveedores'
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->proveedoresRepository->all($request->all());
    }
    /**
     * Create a new record of 'proveedores'
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        return $this->proveedoresRepository->create($request->all());
    }
    /**
     * Update an existing record of 'proveedores'
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        return $this->proveedoresRepository->update($request->all(), $id);
    }

    /**
     * Delete an existing record of 'proveedores'
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->proveedoresRepository->delete($id);
    }


}
