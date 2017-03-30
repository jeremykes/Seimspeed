<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificationmessage extends Model
{
    /**
	* The attributes that arent mass assignable. *
	* @var array
	*/
	protected $guarded = [
    	'message', 
    ];

    /**
    * Get the notifications that have used this notification message.
    */
    // public function notifications()
    // {
        // return $this->hasMany('App\Notifications');
    // }
}
