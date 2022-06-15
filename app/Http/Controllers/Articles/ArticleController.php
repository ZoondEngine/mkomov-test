<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use Inertia\Inertia;
use Inertia\Response;

class ArticleController extends Controller {

    /**
     * @return Response
     */
    public function all(): Response {
        return Inertia::render('Blog/Articles', [
            'articles' => Article::query()->orderByDesc('created_at')->paginate(10)
        ]);
    }

    /**
     * @return Response
     */
    public function index(): Response {
        return Inertia::render('Blog/Index');
    }

    /**
     * @param Tag $tag
     * @return Response
     */
    public function byTags(Tag $tag): Response {
        $paginated = Article::query()->paginate(10);
        $paginated->setCollection(Article::query()->findMany(
            Tag::query()
                ->where('title', $tag->title)
                ->where('tagable_type', Article::class)
                ->get()
                ->pluck('tagable_id')
        ));

        return Inertia::render('Blog/Articles', [
            'articles' => $paginated
        ]);
    }

    /**
     * @param Article $article
     * @return Response
     */
    public function one(Article $article): Response {
        return Inertia::render('Blog/Article', [
            'article' => $article->load([
                'comments',
                'tags'
            ])
        ]);
    }
}
