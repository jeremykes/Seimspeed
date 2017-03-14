<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partsalereserve extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'partsale_id', 
    	'partsaleoffer_id',
    	'note', 
    ];

    /**
	* Get the partsale that owns this reserve.
	*/
	public function sale()
	{
		return $this->BelongsTo('App\Partsale');
	}

	/**
	* Get the part sale offer that owns this reserve.
	*/
	public function offer()
	{
		return $this->BelongsTo('App\Partsaleoffer');
	}

	/**
    * Get the purchase made to this reserve.
    */
    public function purchase()
    {
        return $this->hasOne('App\Partsalepurchase');
    }
}
