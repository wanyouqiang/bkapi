<?php

namespace App\Http\Controllers\API;

use App\Models\ProductCategory;
use BenbenLand\Contracts\Code;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductCategoriesController extends ApiController
{
    /**
     * 商品分类列表，不分页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = ProductCategory::get();

        $rows = [];
        foreach ($categorys as $k => $v) {
            $rows[] = [
                'id' => $v->id,
                'title' => $v->title,
            ];
        }

        $data = [
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
        //
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
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
