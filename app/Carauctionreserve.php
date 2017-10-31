<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carauctionreserve extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'carauction_id', 
    	'carauctionbid_id',
    	'note', 
    ];

    /**
	* Get the carauction that owns this reserve.
	*/
	public function carauction()
	{
		return $this->BelongsTo('App\Carauction');
	}

	/**
	* Get the bid that owns this reserve.
	*/
	public function carauctionbid()
	{
		return $this->BelongsTo('App\Carauctionbid');
	}

	/**
    * Get the purchase made to this reserve.
    */
    public function carauctionpurchase()
    {
        return $this->hasOne('App\Carauctionpurchase');
    }
}
