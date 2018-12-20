<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
	public $fillable = ['product_name','product_description','product_url','product_keyword','product_content','category_id','product_quantity','product_price','product_image'];
    public function category(){
    	return $this->belongsTo('App\models\Category');
    }

    public function comments(){
    	return $this->hasMany('App\models\Comments','product_id');
    }
    public function users()
    {
        return $this->belongsToMany('App\User','carts','product_id','user_id')->withPivot('quantity');
    }

    public function orders(){
        return $this->hasMany('App\models\Orders','product_id');    
    }
    
    
}
