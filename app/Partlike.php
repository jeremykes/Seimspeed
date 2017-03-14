<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partlike extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'user_id', 
    	'part_id',
    ];

    /**
	* Get the user for this like.
	*/
	public function user()
	{
		return $this->BelongsTo('App\User');
	}

	/**
	* Get the part for this like.
	*/
	public function part()
	{
		return $this->BelongsTo('App\Part');
	}
}
