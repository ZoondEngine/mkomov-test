<?php

namespace App\Http\Controllers\Api;

use App\Actions\Blog\Api\Article\CreateComment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Articles\CreateCommentRequest;
use App\Models\Article;
use Illuminate\Http\JsonResponse;

class CommentsApiController extends Controller {
    /**
     * @param CreateCommentRequest $request
     * @param int $articleId
     * @return JsonResponse
     */
    public function store(CreateCommentRequest $request, int $articleId): JsonResponse {
        return (new CreateComment())
            ->execute(array_merge([
                'commentable_id' => $articleId,
                'commentable_type' => Article::class
            ], $request->validated()));
    }
}
