<?php

namespace App\Http\Controllers\API;

use Validator;
use Illuminate\Http\Request;
use BenbenLand\Contracts\Code;
use App\Models\ArticleCategory;

class ArticleCateController extends ApiController
{
    /**
     * 获取文章分类列表
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $articleCategories = ArticleCategory::all();

        $resArr = [];
        foreach ($articleCategories as $articleCategory) {
            $item = [
                'category_id' => $articleCategory->id,
                'title' => $articleCategory->title
            ];
            array_push($resArr, $item);
        }

        return $this->apiResponse('ok', Code::R_OK, $resArr);
    }
}
