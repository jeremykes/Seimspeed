<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
        'user_id_sending', 
    	'user_id_receiving', 
        'message', 
        'seen',
        'read',
    ];

    /**
	* Get the user who made this message.
	*/
	public function sendinguser()
	{
		return $this->BelongsTo('App\User', 'user_id_sending');
	}

    /**
    * Get the user who receives this message.
    */
    public function receivinguser()
    {
        return $this->BelongsTo('App\User', 'user_id_receiving');
    }
}
