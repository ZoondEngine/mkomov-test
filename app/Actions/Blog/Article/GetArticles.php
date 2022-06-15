<?php

namespace App\Actions\Blog\Article;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

class GetArticles {

    /**
     * @param int $limit
     * @return JsonResponse
     */
    public function execute(int $limit = 0): JsonResponse {
        return response()->json([
            'articles' => $limit === 0
                ? Article::query()->orderByDesc('created_at')->paginate(10)
                : Article::query()->orderByDesc('created_at')->limit($limit)->get(),
            'tags' => Tag::query()->get()
        ]);
    }
}
