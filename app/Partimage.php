<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partimage extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'part_id', 
    	'img_url', 
    	'thumb_img_url',
    ];

	/**
	* Get the part that owns this image.
	*/
	public function part()
	{
		return $this->BelongsTo('App\Part');
	}
}
