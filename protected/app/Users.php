<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model as Eloquent;

//class User extends Authenticatable
//class User extends Eloquent
class Users extends Model
{
    protected $table = 'users';
		protected $fillable = [
		'email', 
		'password', 
		'created_at',
		'updated_at'
		];
}
