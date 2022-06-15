<?php

namespace App\Actions\Blog\Api\Article;

use App\Actions\Helpers\HasJsonResponses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class ColumnIncrementor {

    use HasJsonResponses;

    /**
     * @param Model $model
     * @param string $column
     * @return JsonResponse
     */
    public function increment(Model $model, string $column): JsonResponse {
        try {
            if (!$model) {
                return $this->notFound(__('Requested resource not found'));
            } else {
                $model->increment($column);
                return $this->ok('', [
                    $column => $model->{$column}
                ]);
            }
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }
}
