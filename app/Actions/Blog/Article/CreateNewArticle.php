<?php

namespace App\Actions\Blog\Article;

use App\Actions\Helpers\HasJsonResponses;
use App\Models\Article;
use Illuminate\Http\JsonResponse;

class CreateNewArticle {
    use HasJsonResponses;

    public function execute(array $data): JsonResponse {
        try {
            $article = (new Article($data));

            if(!$article->save()) {
                return $this->serverError(__('Cant save new article, please try again later'));
            }
            else {
                return $this->ok(__('New article was saved'), [
                    'article' => $article
                ]);
            }
        }
        catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }
}
