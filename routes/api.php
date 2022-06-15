<?php

use App\Http\Controllers\Api\ArticleApiController;
use App\Http\Controllers\Api\CommentsApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('article')->group(function() {
    Route::get('/load/{count}', [ArticleApiController::class, 'get'])->name('api.article.load');
    Route::put('{articleId}/like', [ArticleApiController::class, 'like'])->name('api.article.like');
    Route::put('{articleId}/view', [ArticleApiController::class, 'view'])->name('api.article.view');
});

Route::prefix('comment')->group(function() {
    Route::post('{articleId}/create', [CommentsApiController::class, 'store'])->name('api.comment.create');
});
