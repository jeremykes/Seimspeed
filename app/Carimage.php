<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carimage extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'car_id', 
    	'img_url', 
    	'thumb_img_url',
    ];

	/**
	* Get the car that owns this image.
	*/
	public function car()
	{
		return $this->BelongsTo('App\Car');
	}
}
