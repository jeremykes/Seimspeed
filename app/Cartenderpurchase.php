<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartenderpurchase extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'cartender_id', 
    	'cartenderreserve_id',
    	'amount', 
    	'tax', 
    	'additionalfees', 
    	'additionalfeesdescript', 
    	'uniquepaymentid', 
    	'method', 
    	'note', 
    ];

    /**
	* Get the cartender that owns this reserve.
	*/
	public function cartender()
	{
		return $this->BelongsTo('App\Cartender');
	}

	/**
	* Get the car tender reserve that owns this purchase.
	*/
	public function cartenderreserve()
	{
		return $this->BelongsTo('App\Cartenderreserve');
	}
}
