<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corpnotificable extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
        'corporate_id',
        'user_id',
        'role',
    ];
}
