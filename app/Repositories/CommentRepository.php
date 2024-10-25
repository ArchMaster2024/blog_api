<?php

namespace App\Repositories;

use App\Repositories\IBasicRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Comment;

class CommentRepository implements IBasicRepository
{
    /**
     * Method for get all models from the database
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Comment::all();
    }

    /**
     * Method for get all models from the database
     *
     * @param int $id
     * @return Comment|null
     */
    public function getOneById(int $id): Comment|null
    {
        return Comment::find($id);
    }

    /**
     * Method for create Comment
     *
     * @param array $model
     * @return Comment
     */
    public function create(array $model): Comment
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
     * @return int
     */
    public function delete(int $id): int
    {
        return Comment::destroy($id);
    }
}
