<?php

namespace App\Repositories;

use App\Repositories\IBasicRepository;
use App\Models\Post;

class PostRespository implements IBasicRepository
{
    /**
     * Method for get all models from the database
     *
     * @return Post
     */
    public function getAll(): Post
    {
        return Post::all();
    }

    /**
     * Method for get all models from the database
     *
     * @param int $id
     * @return Post
     */
    public function getOneById(int $id): Post
    {
        return Post::find($id);
    }

    /**
     * Method for create post
     *
     * @param array $model
     * @return bool
     */
    public function create(array $model): Post
    {
        return Post::create($model);
    }

    /**
     * Method for update post
     *
     * @param array $model
     * @param int $id
     * @return bool
     */
    public function update(array $model, int $id): bool
    {
        return Post::where('id', $id)->update($model);
    }

    /**
     * Method for delete post
     *
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): bool|null
    {
        return Post::where('id', $id)->delete();
    }
}
