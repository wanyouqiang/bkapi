<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Articles extends ResourceCollection
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
                    'body' => $item->body,
                    'is_top' => $item->is_top,
                    'is_hot' => $item->is_hot,
                    'is_new' => $item->is_new,
                    'is_recommend' => $item->is_recommend,
                    'published_at' => $item->published_at,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                    'category' => $item->category ? $item->category->title : '',
                    'user' => $item->user->info ? $item->user->info->nickname : '',
                    'fake_views' => $item->fake_views,
                    'real_views' => $item->real_views,
                ];
            })
        ];
    }
}
