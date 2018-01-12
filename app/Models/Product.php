<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function location()
    {
        return $this->hasOne(ProductLocation::class, 'id', 'location_id');
    }

    public function brand()
    {
        return $this->hasOne(ProductBrand::class, 'id', 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    public function tags() {
        return $this->belongsToMany(ProductTag::class, "product_tag_relations", "product_id", "tag_id");
    }
}
