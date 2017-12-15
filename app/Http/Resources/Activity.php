<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Activity extends Resource
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
                'body' => $this->body,
                'is_top' => $this->is_top,
                'is_hot' => $this->is_hot,
                'is_new' => $this->is_new,
                'is_recommend' => $this->is_recommend,
                'published_at' => $this->published_at,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'category' => $this->category ? $this->category->title : '',
                'user' => $this->user,
                'fake_views' => $this->fake_views,
                'real_views' => $this->real_views,
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
