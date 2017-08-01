<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class slide extends Model
{
    protected $table = 'slide';
		protected $fillable = [		
		'id_category',
		'id_article',
		'slide',
		'video',
		'type',
		'created_at',
		'updated_at',		
		'n_status'	
		]; 
}
