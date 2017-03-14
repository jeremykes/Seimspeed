<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrentpurchase extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'carrent_id', 
    	'carrentreserve_id',
    	'amount', 
    	'tax', 
    	'additionalfees', 
    	'additionalfeesdescript', 
    	'uniquepaymentid', 
    	'method', 
    	'note', 
    ];

    /**
	* Get the carrent that owns this reserve.
	*/
	public function rent()
	{
		return $this->BelongsTo('App\Carrent');
	}

	/**
	* Get the car rent reserve that owns this purchase.
	*/
	public function reserve()
	{
		return $this->BelongsTo('App\Carrentreserve');
	}
}
