<?php

namespace App\Repositories;

use App\Repositories\IBasicRepository;
use App\Models\Comment;

class CommentRepository implements IBasicRepository
{
    /**
     * Method for get all models from the database
     *
     * @return Comment
     */
    public function getAll(): Comment
    {
        return Comment::all();
    }

    /**
     * Method for get all models from the database
     *
     * @param int $id
     * @return Comment
     */
    public function getOneById(int $id): Comment
    {
        return Comment::find($id);
    }

    /**
     * Method for create Comment
     *
     * @param array $model
     * @return bool
     */
    public function create(array $model): bool
    {
        return Comment::create($model);
    }

    /**
     * Method for update Comment
     *
     * @param array $model
     * @param int $id
     * @return bool
     */
    public function update(array $model, int $id): bool
    {
        return Comment::where('id', $id)->update($model);
    }

    /**
     * Method for delete Comment
     *
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): bool|null
    {
        return Comment::where('id', $id)->delete();
    }
}
