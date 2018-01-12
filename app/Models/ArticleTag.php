<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{

    public function articleCate()
    {
        return $this->belongsTo('App\Models\ArticleCategory', 'category_id');
    }
}
