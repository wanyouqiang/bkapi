<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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
}
