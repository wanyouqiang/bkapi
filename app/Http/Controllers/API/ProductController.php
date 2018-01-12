<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Product;
use BenbenLand\Contracts\Code;
use App\Http\Controllers\API\ApiController;

class ProductController extends ApiController
{
    /**
     * 商品列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $products = Product::with('category', 'tags', 'brand')
            ->orderBy('updated_at', 'desc')
            ->where(function ($query) use ($request) {
                if (!empty($request->title)) {
                    $query->where('title', 'like', '%' . $request->title . '%');
                }
            })
            ->where(function ($query) use ($request) {
                if (!empty($request->category_id)) {
                    $query->where('category_id', '=', $request->category_id);
                }
            })
            ->whereHas('tags', function ($query) use ($request) {
                if (!empty($request->tag_id)) {
                    $query->where('tag_id', '=', $request->tag_id);
                }
            })
            ->paginate(15);

        $rows = [];
        foreach ($products as $k => $v) {
            $rows[] = [
                'id' => $v->id,
                'title' => $v->title,
                'thumbnail' => $v->thumbnail,
                'price' => $v->price,
                'price_origin' => $v->price_origin,
                'storage' => $v->storage,
                'sale_min' => $v->sale_min,
                'is_down' => $v->is_down,
                'category_name' => $v->category->title ?? '',
                'tags' => $v->tags->pluck('tag')->toArray() ?? [],
                'brand' => $v->brand->title ?? '',
            ];
        }

        $data = [
            'page' => $products->currentPage(),
            'take' => $products->perPage(),
            'total' => $products->total(),
            'rows' => $rows,
        ];

        return $this->apiResponse('请求成功！', Code::R_OK, $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $product = Product::with('tags')->findOrFail($id);

        $data = [
            "id" => $product->id,
            "category_id" => $product->category_id,
            "location_id" => $product->location_id,
            "brand_id" => $product->brand_id,
            "thumbnail" => $product->thumbnail,
            "title" => $product->title,
            "sub_title" => $product->sub_title,
            "keywords" => $product->keywords,
            "description" => $product->description,
            "price_origin" => $product->price_origin,
            "price" => $product->price,
            "price_express" => $product->price_express,
            "point_max" => $product->point_max,
            "sale_min" => $product->sale_min,
            "sale_max" => $product->sale_max,
            "storage" => $product->storage,
            "unit" => $product->unit,
            "weight" => $product->weight,
            "is_down" => $product->is_down,
            "tags" => $product->tags->pluck("tag")->toArray() ?? '',
        ];

        return $this->apiResponse('请求成功！', Code::R_OK, $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除商品
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id', $id)->delete();
        return $this->apiResponse("删除成功", Code::R_OK);
    }
}
