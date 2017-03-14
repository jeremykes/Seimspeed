<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corporatereport extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'corporate_id', 
    	'user_id', 
    	'report', 
    	'seen', 
    	'valid',
    ];

    /**
	* Get the corporate that this report is for.
	*/
	public function corporate()
	{
		return $this->BelongsTo('App\Corporate');
	}

	/**
	* Get the user that owns this report.
	*/
	public function user()
	{
		return $this->BelongsTo('App\User');
	}
}
