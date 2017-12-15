<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function category()
    {
        return $this->hasOne(ActivityCategory::class, 'id', 'category_id');
    }

    public function tags()
    {
        return $this->hasMany(ActivityTagRelation::class);
    }
    
    public function province()
    {
        return $this->hasOne(Region::class, 'id', 'province_id');
    }

    public function city()
    {
        return $this->hasOne(Region::class, 'id', 'city_id');
    }

    public function dist()
    {
        return $this->hasOne(Region::class, 'id', 'dist_id');
    }
}
