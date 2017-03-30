<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'user_id', 
    	'notificationmessage_id', 
    	'url', 
    	'message', 
    ];

    /**
	* Get the user who this notification is for.
	*/
	public function user()
	{
		return $this->BelongsTo('App\User');
	}

	/**
	* Get the notification message.
	*/
	public function message()
	{
		return $this->BelongsTo('App\Notificationmessage');
	}
}
