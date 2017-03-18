<?php

namespace App\Repositories\Services;

interface RepositoryManagerInterface {


    /**
     * GET METHOD
     * Display list of entities
     * @param array $request
     * @return mixed
     */
    public function all(array $request);

    /**
     * POST METHOD
     * Create a new record of the entity
     * @param array $request
     * @return mixed
     */
    public function create(array $request);

    /**
     * DELETE METHOD
     * Delete an existing record of the entity
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * PUT METHOD
     * Update an existing record of the entity
     * @param array $request
     * @param $id
     * @return mixed
     */
    public function update(array $request, $id);

}