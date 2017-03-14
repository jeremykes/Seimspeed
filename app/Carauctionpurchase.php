<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carauctionpurchase extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
		'carauction_id', 
    	'carauctionreserve_id', 
    	'amount', 
    	'tax', 
    	'additionalfees', 
    	'additionalfeesdescript', 
    	'uniquepaymentid', 
    	'method', 
    	'note',
    ];

    /**
	* Get the carauction that owns this purchase.
	*/
	public function auction()
	{
		return $this->BelongsTo('App\Carauction');
	}

	/**
	* Get the car auction reserve that owns this purchase.
	*/
	public function reserve()
	{
		return $this->BelongsTo('App\Carauctionreserve');
	}
}
