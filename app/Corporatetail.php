<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corporatetail extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'user_id', 
    	'corporate_id',
    ];

    /**
	* Get the user for this tail.
	*/
	public function user()
	{
		return $this->BelongsTo('App\User');
	}

	/**
	* Get the corporation for this tail.
	*/
	public function corporate()
	{
		return $this->BelongsTo('App\Corporate');
	}
}
