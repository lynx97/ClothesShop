<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class order_histories extends Model
{
    public $fillable = ['admin_id','order_id','status'];
    protected $table= "order_histories";
	public $timestamps = false;
}
