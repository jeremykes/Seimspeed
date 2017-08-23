<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrentoffer extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'carrent_id', 
    	'user_id', 
    	'daysofrent',
    	'offer', 
    ];

    /**
	* Get the carrent that owns this offer.
	*/
	public function carrent()
	{
		return $this->BelongsTo('App\Carrent');
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
    public function carrentreserve()
    {
        return $this->hasOne('App\Carrentreserve');
    }
}
