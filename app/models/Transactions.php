<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class transactions extends Model
{
    
    public $fillable = ['user_id','total_money','status'];
}
