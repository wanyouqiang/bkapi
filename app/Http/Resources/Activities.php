<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Activities extends ResourceCollection
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
                    'summary' => $item->summary,
                    'body' => $item->body,
                    'type' => $item->type,
                    'price_origin' => $item->price_origin,
                    'price' => $item->price,
                    'status' => $item->status,
                    'is_top' => $item->is_top,
                    'is_hot' => $item->is_hot,
                    'is_new' => $item->is_new,
                    'is_recommend' => $item->is_recommend,
                    'people_limit' => $item->people_limit,
                    'started_at' => $item->started_at,
                    'ended_at' => $item->ended_at,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                    'category' => $item->category ? $item->category->title : '',
                    'tags' => $item->tags ? $item->tags : [],
                    'user' => $item->user,
                    'province' => $item->province ? $item->province->area_name : '',
                    'city' => $item->city ? $item->city->area_name : '',
                    'dist' => $item->dist ? $item->dist->area_name : '',
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
