<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carsalepurchase extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'carsale_id', 
    	'carsalereserve_id',
    	'amount', 
    	'tax', 
    	'additionalfees', 
    	'additionalfeesdescript',
    	'uniquepaymentid',  
    	'method', 
    	'note', 
    ];

    /**
	* Get the carsale that owns this purchase.
	*/
	public function sale()
	{
		return $this->BelongsTo('App\Carsale');
	}

	/**
	* Get the car sale reserve that owns this purchase.
	*/
	public function reserve()
	{
		return $this->BelongsTo('App\Carsalereserve');
	}
}
