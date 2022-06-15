<?php

namespace App\Actions\Blog\Api\Article;

use App\Actions\Helpers\HasJsonResponses;
use App\Models\Article;
use Illuminate\Http\JsonResponse;

class IncrementViews {
    /**
     * @param int $articleId
     * @return JsonResponse
     */
    public function execute(int $articleId): JsonResponse
    {
        return (new ColumnIncrementor())->increment(
            Article::query()->find($articleId),
            'views'
        );
    }
}
