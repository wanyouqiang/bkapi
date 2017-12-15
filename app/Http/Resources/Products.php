<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Products extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'thumbnail' => $item->thumbnail,
                    'title' => $item->title,
                    'sub_title' => $item->sub_title,
                    'keywords' => $item->keywords,
                    'storage' => $item->storage,
                    'description' => $item->description,
                    'price_origin' => $item->price_origin,
                    'price' => $item->price,
                    'price_express' => $item->price_express,
                    'point_max' => $item->point_max,
                    'sale_min' => $item->sale_min,
                    'sale_max' => $item->sale_max,
                    'unit' => $item->uint,
                    'is_top' => $item->is_top,
                    'is_hot' => $item->is_hot,
                    'is_new' => $item->is_new,
                    'is_recommend' => $item->is_recommend,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                    'country_name' => $item->location ? $item->location->country_name : '中国馆',
                    'brand_title' => $item->brand ? $item->brand->title : '-',
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'error' => 0,
            'msg' => 'Success'
        ];
    }
}
