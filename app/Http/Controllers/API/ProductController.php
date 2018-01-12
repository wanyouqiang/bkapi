<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Product;
use BenbenLand\Contracts\Code;
use App\Http\Controllers\API\ApiController;

class ProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $products = Product::with("category", "tags")
            ->orderBy('updated_at', 'desc')
            ->where(function($query) use($request){
                if (!empty($request->title)) {
                    $query->where("title","like",'%' . $request->title . '%');
                }
            })
            ->where(function($query) use($request){
                if (!empty($request->category_id)) {
                    $query->where("category_id","=", $request->category_id);
                }
            })
            ->paginate(15);
//        dd($products);

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
                "category_name" => $v->category->title ?? '',
            ];
//            dd($v->tags);


            //标签处理
            $rows[$k]['tags'] = '';
            foreach ($v->tags as $tag) {
                $rows[$k]['tags'] .= $tag->tag . ',';
            }
        }
        dd($rows);
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
