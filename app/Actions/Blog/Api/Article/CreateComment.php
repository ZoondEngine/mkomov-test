<?php

namespace App\Actions\Blog\Api\Article;

use App\Actions\Helpers\HasJsonResponses;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;

class CreateComment {
    use HasJsonResponses;

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function execute(array $data): JsonResponse {
        try {
            $comment = (new Comment($data));

            if(!$comment->save()) {
                return $this->serverError(__('Cant save new comment, please try again later'));
            }
            else {
                return $this->ok(__('New article was saved'), [
                    '$comment' => $comment
                ]);
            }
        }
        catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }
}
