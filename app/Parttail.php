<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parttail extends Model
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
	* Get the user for this tail.
	*/
	public function user()
	{
		return $this->BelongsTo('App\User');
	}

	/**
	* Get the part for this tail.
	*/
	public function part()
	{
		return $this->BelongsTo('App\Part');
	}
}
