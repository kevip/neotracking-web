<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use App\Repositories\Services\RepositoryManagerInterface;

class RepositoryManager implements RepositoryManagerInterface{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;

    }
    /**
     * Display list of entities
     * @param array $request
     * @return mixed
     */
    public function all(array $request)
    {
        return $this->model->all();
    }

    /**
     * Create a new record of the entity
     * @param array $request
     * @return mixed
     */
    public function create(array $request)
    {
        return $this->model->create($request);
    }

    /**
     * Delete an existing record of the entity
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * Update an existing record of the entity
     * @param array $request
     * @param $id
     * @return mixed
     */
    public function update(array $request, $id)
    {
        // TODO: Implement delete() method.
    }
}