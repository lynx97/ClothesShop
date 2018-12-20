<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','first_name','last_name','confirmed', 'user_phone','user_address','user_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function carts()
    {
        return $this->belongsToMany('App\models\Products','carts','user_id','product_id')->withPivot('quantity');
    }

    public function orders()
    {
        return $this->hasManyThrough('App\models\Orders', 'App\models\Transactions', 'user_id', 'transaction_id');
    }

}
