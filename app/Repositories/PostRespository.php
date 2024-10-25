<?php

namespace App\Repositories;

use App\Repositories\IBasicRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Post;

class PostRespository implements IBasicRepository
{
    /**
     * Method for get all models from the database
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Post::all();
    }

    /**
     * Method for get all models from the database
     *
     * @param int $id
     * @return Post|null
     */
    public function getOneById(int $id): Post|null
    {
        return Post::find($id);
    }

    /**
     * Method for create post
     *
     * @param array $model
     * @return Post
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
     * @return int
     */
    public function delete(int $id): int
    {
        return Post::destroy($id);
    }
}
