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
            ->where(function($query) use($request){
                if (!empty($request->title)) {
                    $query->where('title','like','%' . $request->title . '%');
                }
            })
            ->where(function($query) use($request){
                if (!empty($request->category_id)) {
                    $query->where('category_id','=', $request->category_id);
                }
            })
            ->whereHas('tags', function ($query) use($request){
                if (!empty($request->tag_id)) {
                    $query->where('tag_id','=', $request->tag_id);
                }
            })
            ->paginate(15);

        $rows = [];
        foreach ($products as $k => $v){
            $rows[]= [
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
            'currentPage' => $products->currentPage(),
            'perPage' => $products->perPage(),
            'total' => $products->total(),
            'lastPage' => $products->lastPage(),
            'rows' => $rows
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
