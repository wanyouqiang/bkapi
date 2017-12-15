<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function wechat()
    {
        return $this->hasOne(UserWechat::class);
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function babies()
    {
        return $this->hasMany(UserBaby::class);
    }

    public function info()
    {
        return $this->hasOne(UserInfo::class);
    }
}
