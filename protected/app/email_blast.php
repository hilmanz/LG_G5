<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class email_blast extends Model
{
     protected $table = 'tbl_email_blast';
		protected $fillable = [
		'id', 
		'user_id', 
		'email',
		'n_status',
		'created_at',
		'updated_at',	
		]; 
}
