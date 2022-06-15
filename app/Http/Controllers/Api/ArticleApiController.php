<?php

namespace App\Http\Controllers\Api;

use App\Actions\Blog\Api\Article\IncrementLike;
use App\Actions\Blog\Api\Article\IncrementViews;
use App\Actions\Blog\Article\CreateNewArticle;
use App\Actions\Blog\Article\GetArticles;
use App\Http\Controllers\Controller;
use App\Http\Requests\Articles\CreateNewArticleRequest;
use Illuminate\Http\JsonResponse;

class ArticleApiController extends Controller {

    /**
     * @param int $count
     * @return JsonResponse
     */
    public function get(int $count): JsonResponse {
        return (new GetArticles())->execute($count);
    }

    /**
     * @param CreateNewArticleRequest $request
     * @return JsonResponse
     */
    public function store(CreateNewArticleRequest $request): JsonResponse {
        return (new CreateNewArticle())
            ->execute($request->validated());
    }

    /**
     * @param int $articleId
     * @return JsonResponse
     */
    public function like(int $articleId): JsonResponse {
        return (new IncrementLike())->execute($articleId);
    }

    /**
     * @param int $articleId
     * @return JsonResponse
     */
    public function view(int $articleId): JsonResponse {
        return (new IncrementViews())->execute($articleId);
    }
}
