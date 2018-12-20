<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public $fillable = ['category_name','category_description','category_url','status'];
	protected $table= "categories";
	public $timestamps = false;
    //
	public function products(){
		return $this->hasMany('App\models\Products');
	}
}
