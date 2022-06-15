<?php

use App\Http\Controllers\Articles\ArticleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ArticleController::class, 'index'])->name('index');

Route::prefix('blog')->group(function() {
    Route::get('/all', [ArticleController::class, 'all'])->name('blog.all');
    Route::get('{article}/view', [ArticleController::class, 'one'])->name('blog.view');
    Route::get('{tag}/by-tags', [ArticleController::class, 'byTags'])->name('blog.articles.by-tags');
});
