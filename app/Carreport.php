<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carreport extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'car_id', 
    	'user_id', 
    	'report', 
    	'seen', 
    	'valid',
    ];

    /**
	* Get the car that this report is for.
	*/
	public function car()
	{
		return $this->BelongsTo('App\Car');
	}

	/**
	* Get the user that owns this report.
	*/
	public function user()
	{
		return $this->BelongsTo('App\User');
	}
}
