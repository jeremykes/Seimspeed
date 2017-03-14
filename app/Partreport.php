<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partreport extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'part_id', 
    	'user_id', 
    	'report', 
    	'seen', 
    	'valid',
    ];

    /**
	* Get the part that this report is for.
	*/
	public function part()
	{
		return $this->BelongsTo('App\Part');
	}

	/**
	* Get the user that owns this report.
	*/
	public function user()
	{
		return $this->BelongsTo('App\User');
	}
}
