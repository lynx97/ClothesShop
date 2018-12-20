<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
	protected $fillable = [
        'admin_name', 'admin_email', 'password', 'admin_phone', 'admin_status'
    ];
    protected $table="admins";
    
}
