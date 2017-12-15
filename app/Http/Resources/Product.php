<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Product extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => $this->id,
                'thumbnail' => $this->thumbnail,
                'title' => $this->title,
                'sub_title' => $this->sub_title,
                'keywords' => $this->keywords,
                'sku' => $this->sku,
                'description' => $this->description,
                'price_origin' => $this->price_origin,
                'price' => $this->price,
                'price_express' => $this->price_express,
                'point_max' => $this->point_max,
                'sale_min' => $this->sale_min,
                'sale_max' => $this->sale_max,
                'unit' => $this->uint,
                'is_top' => $this->is_top,
                'is_hot' => $this->is_hot,
                'is_new' => $this->is_new,
                'is_recommend' => $this->is_recommend,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'galleries' => $this->galleries->map(function($item) {
                    return $item->image;
                }),
            ]
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
