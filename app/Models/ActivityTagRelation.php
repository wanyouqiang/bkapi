<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityTagRelation extends Model
{
    public function tag()
    {
        return $this->hasOne(ActivityTag::class);
    }
}
