<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carlike extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'user_id', 
    	'car_id',
    ];

    /**
	* Get the user for this like.
	*/
	public function user()
	{
		return $this->BelongsTo('App\User');
	}

	/**
	* Get the car for this like.
	*/
	public function car()
	{
		return $this->BelongsTo('App\Car');
	}
}
