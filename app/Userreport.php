<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userreport extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'reporting_user_id', 
    	'report_user_id', 
    	'report', 
    	'seen', 
    	'valid',
    ];

    /**
	* Get the user making this report.
	*/
	public function reporting_user()
	{
		return $this->BelongsTo('App\User', 'reporting_user_id');
	}

	/**
	* Get the user being reported.
	*/
	public function report_user()
	{
		return $this->BelongsTo('App\User', 'report_user_id');
	}
}
