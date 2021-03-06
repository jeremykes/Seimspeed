<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carsaleoffer extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'carsale_id', 
    	'user_id', 
    	'offer',
    ];

    /**
	* Get the carsale that owns this offer.
	*/
	public function carsale()
	{
		return $this->BelongsTo('App\Carsale');
	}

	/**
	* Get the user that owns this offer.
	*/
	public function user()
	{
		return $this->BelongsTo('App\User');
	}

	/**
    * Get the reserved record to this offer.
    */
    public function carsalereserve()
    {
        return $this->hasOne('App\Carsalereserve');
    }
}
