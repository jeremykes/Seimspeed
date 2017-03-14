<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usersetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'user_id',
        'receive_email_notifications', 
    ];

    /**
    * Get the user record associated with this settings.
    */
    public function user()
    {
        return $this->BelongsTo('App\User');
    }
}
