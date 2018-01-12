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
    const PER_PAGE = 15;

    public function index(Request $request)
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
            $previewToken = md5((config('flybaby.preview_salt') . $article->id));

            $data['rows'][] = [
                'article_id' => $article->id,
                'title' => $article->title,
                'category' => $article->articleCate->title,
                'article_url' => sprintf(config('flybaby.article_url_tpl'), $article->id),
                'preview_url' => $previewToken,
                'preview_url' => sprintf(config('flybaby.article_url_tpl'), $article->id) . '?pt=' . $previewToken,
                'thumbnail' => $article->thumbnail,
                'fake_views' => $article->fake_views,
                'real_views' => $article->real_views,
                'published_at' => $article->published_at,
            ];
        }

        return $this->apiResponse('ok', Code::R_OK, $data);
    }

    public function show($articleId)
    {
        $article = Article::with('articleCate')->findOrFail($articleId);

        $data = [
            'id' => $article->id,
            'category' => $article->articleCate->title,
            'tag' => $article->articleCate->articleTags->pluck('tag')->toArray() ?? '',
            'thumbnail' => $article->thumbnail,
            'title' => $article->title,
            'sub_title' => $article->sub_title,
            'body' => $article->body,
            'published_at' => $article->published_at
        ];

        return $this->apiResponse('请求成功！', Code::R_OK, $data);
    }

    public function update(Request $request)
    {
        $articleId = $request->input('article_id');
        $title = $request->input('title');
        $sub_title = $request->input('sub_title');
        $body = $request->input('body');
        $published_at = $request->input('published_at');
        $thumbnail = $request->input('thumbnail');

        $article = Article::find($articleId);
        $article->title = $title;
        $article->sub_title = $sub_title;
        $article->body = $body;
        $article->thumbnail = $thumbnail;
        $article->published_at = $published_at;

        $article->save();

        return $this->apiResponse('修改成功！', Code::R_OK, []);
    }

    public function delete($articleId)
    {
        Article::destroy($articleId);

        return $this->apiResponse('删除成功', Code::R_OK, []);
    }
}
