<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Repositories\CommentRepository;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Validations\ExitsRecord;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(private CommentRepository $repository){}

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();
        $response = [];
        if (ExitsRecord::ById($id, 'posts') == false) {
            $response = [
                'title' => 'The post you comment not exists',
                'status' => 404,
            ];
            return response()->json($response);
        }
        $validated = $request->safe()->merge(['post_id' => $id]);
        $comment = $this->repository->create($validated->all());
        if (!is_object($comment)) {
            $response = [
                'title' => 'We had an error when saving your comment, please try again later',
                'status' => 404,
            ];
            return response()->json($response);
        }
        $response = [
            'title' => 'Comment created successfully',
            'status' => 201,
        ];
        return response()->json($response);
    }
}
