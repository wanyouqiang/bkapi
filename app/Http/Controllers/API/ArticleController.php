<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiController;
use DB;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use BenbenLand\Contracts\Code;
use Illuminate\Http\Request;

class ArticleController extends ApiController
{
    const PER_PAGE = 4;
    public function getAll(Request $request)
    {
        $category_id = $request->input('category_id');
        $tag_id = $request->input('tag_id');
        $keywords = $request->input('keywords');
        $page = $request->input('page', 1);

        $articles = Article::whereRaw('1=1');

        if (isset($tag_id)) {
            $tags = ArticleTag::find($tag_id);
            $categoriesIds = $tags->articleCate->pluck('id')->toArray();
            $articles->whereIn('category_id', $categoriesIds);
        }

        if (isset($category_id)) {
            $cates = ArticleCategory::find($category_id);
            $articlesIds = $cates->articles->pluck('id')->toArray();
            $articles->whereIn('id', $articlesIds);
        }

        if (isset($keywords)) {
            $articles->where('title', 'like', "%${keywords}%");
        }

        $articles = $articles->paginate(self::PER_PAGE);

        $data = [
            'total' => $articles->total(),
            'page' => $articles->currentPage(),
            'take' => $articles->perPage(),
            'rows' => [],
        ];

        foreach ($articles as $article) {
            $data['rows'][] = [
                'article_id' => $article->id,
                'title' => $article->title,
                'category' => $article->articleCate->title,
                'article_url' => sprintf(config('flybaby.article_url_tpl'), $article->id),
                'thumbnail' => $article->thumbnail,
                'fake_views' => $article->fake_views,
                'real_views' => $article->real_views,
                'published_at' => $article->published_at,
            ];
        }

        return $this->apiResponse('ok', Code::R_OK, $data);
    }
}
