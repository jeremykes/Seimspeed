<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrentreserve extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'carrent_id', 
    	'carrentoffer_id',
    	'note', 
    ];

    /**
	* Get the carrent that owns this reserve.
	*/
	public function carrent()
	{
		return $this->BelongsTo('App\Carrent');
	}

	/**
	* Get the part sale offer that owns this reserve.
	*/
	public function carrentoffer()
	{
		return $this->BelongsTo('App\Carrentoffer');
	}

	/**
    * Get the purchase made to this reserve.
    */
    public function carrentpurchase()
    {
        return $this->hasOne('App\Carrentpurchase');
    }
}