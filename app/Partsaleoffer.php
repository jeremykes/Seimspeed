<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partsaleoffer extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'partsale_id', 
    	'user_id', 
    	'offer', 
    ];

    /**
	* Get the partsale that owns this offer.
	*/
	public function partsale()
	{
		return $this->BelongsTo('App\Partsale');
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
    public function partsalereserve()
    {
        return $this->hasOne('App\Partsalereserve');
    }
}
