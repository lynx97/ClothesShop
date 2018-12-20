<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
	public $fillable = ['order_id','user_id','rate_mark'];
    protected $table= "rates";
	public $timestamps = false;

	public function users(){
		return $this->hasMany('App\User');
	}
	public function orders(){
		return $this->hasMany('App\models\Orders');
	}
	public function transactions(){
		return $this->hasMany('App\models\Transactions');
	}
}
