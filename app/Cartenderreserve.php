<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartenderreserve extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'cartender_id', 
    	'cartendertender_id',
    	'note', 
    ];

    /**
	* Get the cartender that owns this reserve.
	*/
	public function tender()
	{
		return $this->BelongsTo('App\Cartender');
	}

	/**
	* Get the tender that owns this reserve.
	*/
	public function tendertender()
	{
		return $this->BelongsTo('App\Cartendertender');
	}

	/**
    * Get the purchase made to this reserve.
    */
    public function purchase()
    {
        return $this->hasOne('App\Cartenderpurchase');
    }
}
