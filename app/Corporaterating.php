<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corporaterating extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'corporate_id', 
    	'user_id', 
    	'rating', 
    	'comment',
    ];

    /**
	* Get the corporate that this rating is for.
	*/
	public function corporate()
	{
		return $this->BelongsTo('App\Corporate');
	}

	/**
	* Get the user that owns this rating.
	*/
	public function user()
	{
		return $this->BelongsTo('App\User');
	}
}
