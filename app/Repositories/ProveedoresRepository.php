<?php

namespace App\Repositories;


use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Model;

class ProveedoresRepository extends RepositoryManager
{
    public function __construct(Proveedor $proveedor)
    {
        parent::__construct($proveedor);
    }

}