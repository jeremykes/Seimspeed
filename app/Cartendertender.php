<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartendertender extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'cartender_id', 
    	'user_id', 
    	'tender',
    ];

    /**
	* Get the cartender that owns this tender.
	*/
	public function cartender()
	{
		return $this->BelongsTo('App\Cartender');
	}

	/**
	* Get the user that owns this tender.
	*/
	public function user()
	{
		return $this->BelongsTo('App\User');
	}

	/**
    * Get the reserved record to this tender.
    */
    public function cartenderreserve()
    {
        return $this->hasOne('App\Cartenderreserve');
    }





	

	
}
