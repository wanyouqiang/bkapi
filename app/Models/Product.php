<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * 相册
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }

    /**
     * 国家
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function location()
    {
        return $this->hasOne(ProductLocation::class, 'id', 'location_id');
    }

    /**
     * 品牌
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function brand()
    {
        return $this->hasOne(ProductBrand::class, 'id', 'brand_id');
    }

    /**
     * 分类
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    /**
     * 标签
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags() {
        return $this->belongsToMany(ProductTag::class, "product_tag_relations", "product_id", "tag_id");
    }
}
