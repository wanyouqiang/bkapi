<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleCategory extends Model
{
    use SoftDeletes;

    protected $table = 'article_categories';
    protected $dates = ['deleted_at'];


    public function articleTags()
    {
        return $this->hasMany('App\Models\ArticleTag', 'category_id');
    }

    public function articles()
    {
        return $this->hasMany('App\Models\Article', 'category_id');
    }

}
