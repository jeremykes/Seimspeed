<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carsalereserve extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'carsale_id', 
    	'carsaleoffer_id',
    	'note', 
    ];

    /**
	* Get the carsale that owns this reserve.
	*/
	public function carsale()
	{
		return $this->BelongsTo('App\Carsale');
	}

	/**
	* Get the car sale offer that owns this reserve.
	*/
	public function carsaleoffer()
	{
		return $this->BelongsTo('App\Carsaleoffer');
	}

	/**
    * Get the purchase made to this reserve.
    */
    public function carsalepurchase()
    {
        return $this->hasOne('App\Carsalepurchase');
    }
}
