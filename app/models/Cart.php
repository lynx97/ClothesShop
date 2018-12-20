<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table= "carts";
    public $fillable = ['user_id','product_id', 'quantity'];
	public $timestamps = false;
	
}
