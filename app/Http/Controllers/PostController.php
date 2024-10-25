<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Repositories\PostRespository;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;

class PostController extends Controller implements HasMiddleware
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(private PostRespository $repository){}

    /**
     * Get the middleware assigned to the controller.
     *
     * @return array
     */
    public static function middleware(): array
    {
        return [new Middleware('auth:sanctum', only: ['store', 'update', 'destroy'])];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $posts = $this->repository->getAll();
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $response = [];
        $post = $this->repository->create($validated);
        if (!is_object($post)) {
            $response = [
                'title' => 'We had an error when saving your post, please try again later',
                'status' => 500,
            ];
            return response()->json($response);
        }
        $response = [
            'title' => 'Post created successfully',
            'status' => 201,
        ];
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $post = $this->repository->getOneById($id);
        if (!is_object($post)) {
            $post = [
                'title' => 'The post you search not exist',
                'status' => 200
            ];
        }
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();
        $response = [];
        $post = $this->repository->update($validated, $id);
        if ($post == false) {
            $response = [
                'title' => 'We had an error when updating your post, please try again later',
                'status' => 500,
            ];
            return response()->json($response);
        }
        $response = [
            'title' => 'Post updated successfully',
            'status' => 201,
        ];
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $response = [];
        $post = $this->repository->delete($id);
        if ($post == 0) {
            $response = [
                'title' => 'We had an error when deleting your post, please try again later',
                'status' => 500,
            ];
            return response()->json($response);
        }
        $response = [
            'title' => 'Post deleted successfully',
            'status' => 200,
        ];
        return response()->json($response);
    }
}
