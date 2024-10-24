<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface IBasicRepository
{
    /**
     * Method for get all models from the database
     */
    public function getAll(): Model;

    /**
     * Method for get one model by id from database
     *
     * @param int $id
     */
    public function getOneById(int $id): Model;

    /**
     * Method for create model
     *
     * @param array $model
     */
    public function create(array $model): Model;

    /**
     * Method for create model
     *
     * @param array $model
     * @param int $id
     */
    public function update(array $model, int $id): bool;

    /**
     * Method for delete model
     *
     * @param int $id
     */
    public function delete(int $id): bool|null;
}
