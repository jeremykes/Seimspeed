<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartendertenderer extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'cartender_id', 
    	'user_id', 
    	'accepted', 
    	'paid', 
    ];

    /**
	* Get the cartender that owns this tenderer.
	*/
	public function tender()
	{
		return $this->BelongsTo('App\Cartender');
	}

	/**
	* Get the user record associated with this tenderer.
	*/
	public function user()
	{
		return $this->BelongsTo('App\User');
	}
}
