<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socialprofile extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'user_id', 
    	'provider', 
    	'social_id', 
    	'propic', 
    	'profilepicurl',
    ];

    /**
	* Get the user that this social profile is for.
	*/
	public function user()
	{
		return $this->BelongsTo('App\User');
	}
}
