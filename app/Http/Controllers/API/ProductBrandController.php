<?php

namespace App\Http\Controllers\API;

use App\Models\ProductBrand;
use BenbenLand\Contracts\Code;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductBrandController extends ApiController
{
    /**
     * 商品品牌列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = ProductBrand::get();

        $rows = [];
        foreach ($brands as $k => $v) {
            $rows[] = [
                'id' => $v->id,
                'logo' => $v->logo,
                'title' => $v->title,
                'description' => $v->description,
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
