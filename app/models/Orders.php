<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    public $fillable = ['transaction_id','product_id','quantity','price','status'];

    public function product(){
    	return $this->hasOne('App\models\Products','id', 'product_id');
    }

    public function rate(){
        return $this->hasOne('App\models\Rate','order_id','id');
    }

}
