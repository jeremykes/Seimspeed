<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carcomment extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'parent_comment_id', 
    	'user_id', 
    	'car_id', 
    	'comment',
    ];

    /**
	* Get the user making this comment.
	*/
	public function user()
	{
		return $this->BelongsTo('App\User');
	}

	/**
	* Get the car that owns this comment.
	*/
	public function car()
	{
		return $this->BelongsTo('App\Car');
	}
}
