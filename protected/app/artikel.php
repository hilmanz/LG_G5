<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class artikel extends Model
{
    protected $table = 'article';
		protected $fillable = [
		'id_category', 
		'title', 
		'event_date',
		'content',
		'banner',		
		'position',
		'created_at',
		'updated_at',
		'id_user',
		'n_status'	
		]; 
}
