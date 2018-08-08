<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carauctionbidder extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'carauction_id', 
    	'user_id', 
    	'accepted', 
    	'paid', 
    ];

    /**
	* Get the carauction that owns this bidder.
	*/
	public function carauction()
	{
		return $this->BelongsTo('App\Carauction');
	}

	/**
	* Get the user record associated with this bidder.
	*/
	public function user()
	{
		return $this->BelongsTo('App\User');
	}
}
