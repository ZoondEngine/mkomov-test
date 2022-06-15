<?php

namespace App\Actions\Helpers;

use Illuminate\Http\JsonResponse;

trait HasJsonResponses
{
    /**
     * @param string $message
     * @param array $data
     * @return JsonResponse
     */
    protected function notFound(string $message = '', array $data = []): JsonResponse {
        return $this->make(404, $message, $data);
    }

    /**
     * @param string $message
     * @param array $data
     * @return JsonResponse
     */
    protected function ok(string $message = '', array $data = []): JsonResponse {
        return $this->make(200, $message, $data);
    }

    /**
     * @param string $message
     * @param array $data
     * @return JsonResponse
     */
    protected function permissionsDenied(string $message = '', array $data = []): JsonResponse {
        return $this->make(403, $message, $data);
    }

    /**
     * @param string $message
     * @param array $data
     * @return JsonResponse
     */
    protected function serverError(string $message = '', array $data = []): JsonResponse {
        return $this->make(500, $message, $data);
    }

    /**
     * @param int $code
     * @param string $message
     * @param array $data
     * @return JsonResponse
     */
    protected function make(int $code, string $message = '', array $data = []): JsonResponse {
        return response()->json([
            'code' => $code,
            'message' => $message === ''
                ? JsonResponse::$statusTexts[$code]
                : $message,
            'data' => $data
        ], $code);
    }
}
