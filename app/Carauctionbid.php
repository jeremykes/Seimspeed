<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carauctionbid extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'carauction_id', 
    	'user_id', 
    	'bid',
    ];

    /**
	* Get the carauction that owns this bid.
	*/
	public function auction()
	{
		return $this->BelongsTo('App\Carauction');
	}

	/**
	* Get the user that owns this bid.
	*/
	public function user()
	{
		return $this->BelongsTo('App\User');
	}

	/**
    * Get the reserved record to this bid.
    */
    public function reserve()
    {
        return $this->hasOne('App\Carauctionreserve');
    }	
}
