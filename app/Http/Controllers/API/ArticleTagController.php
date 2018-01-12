<?php

namespace App\Http\Controllers\API;

use BenbenLand\Contracts\Code;
use App\Models\ArticleTag;
use Illuminate\Http\Request;

class ArticleTagController extends ApiController
{
    public function index(Request $request)
    {
        $category_id = $request->input('category_id');
        if (isset($category_id)) {
            $articleTags = ArticleTag::where('category_id', $category_id)->get();
        } else {
            $articleTags = ArticleTag::all();
        }

        $resArr = [];

        foreach ($articleTags as $articleTag) {
            $item = [
              'tag_id' => $articleTag->id,
              'tag' => $articleTag->tag,
            ];
            array_push($resArr, $item);
        }

        return $this->apiResponse('ok', Code::R_OK, $resArr);
    }

}
