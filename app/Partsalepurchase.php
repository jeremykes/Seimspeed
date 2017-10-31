<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partsalepurchase extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
		'partsale_id', 
		'partsalereserve_id',
    	'amount', 
    	'tax', 
    	'additionalfees', 
    	'additionalfeesdescript', 
    	'uniquepaymentid', 
    	'method', 
    	'note', 
    ];

    /**
	* Get the partsale that owns this purchase.
	*/
	public function partsale()
	{
		return $this->BelongsTo('App\Partsale');
	}

	/**
	* Get the part sale reserve that owns this purchase.
	*/
	public function partsalereserve()
	{
		return $this->BelongsTo('App\Partsalereserve');
	}
}
