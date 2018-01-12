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
                'article_url' => sprintf(config('flybaby.article_url_tpl'), $article->id)
            ];
        }

        return $this->apiResponse('ok', Code::R_OK, $data);
    }

    public function test()
    {
        $category_id = $request->input('category_id');
        $tag_id = $request->input('tag_id');
        $keywords = $request->input('keywords');
        $page = $request->input('page', 1);

        $totalNum = Article::all()->count();
        $perPageNum = env('ARTICLE_PAGE_NUM');

        $totalPage = ceil($totalNum / $perPageNum);

        $startNum = ($page - 1) * $perPageNum;

        $sql = 'select articles.id, articles.title, article_categories.title as category_title from articles left join article_categories on articles.category_id = article_categories.id left join article_tags on article_categories.id=article_tags.category_id ';
        $sql .= isset($category_id) ? 'where article_categories.id = ' . $category_id : '';
        if (isset($tag_id)) {
            $bool = preg_match('/where/', $sql);
            $sql .= $bool ? 'and article_tags.id=' : 'where article_tags.id=';
            $sql .= $tag_id;
        }

        if (isset($keywords)) {
            $bool = preg_match('/where/', $sql);
            $sql .= $bool ? 'articles.title like' : 'where articles.title like';
            $sql .= $keywords;
        }

        $sql .= sprintf("limit %d %d", $startNum, $perPageNum);

        $articles = DB::select($sql);
        $resArr = [];

        foreach ($articles as $article) {
            $item = [
                'article_id' => $article->id,
                'title' => $article->title,
                'category' => $article->category_title,
                'article_url' => sprintf(config('flybaby.article_url_tpl'), $article->id)
            ];
            array_push($resArr, $item);
        }

        return $this->apiResponse('ok', Code::R_OK, $resArr);
    }
}
