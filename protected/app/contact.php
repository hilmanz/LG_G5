<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
     protected $table = 'registration';
		protected $fillable = [
		'id', 
		'nama', 
		'email',
		'telp',
		'kode',
		'created_at',
		'updated_at',	
		]; 
}
