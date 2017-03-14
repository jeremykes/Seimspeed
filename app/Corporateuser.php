<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corporateuser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'corporate_id', 
        'user_id', 
        'title',
    ];

    /**
	* Get the corporation that this corporateuser belongs to.
	*/
	public function corporate()
	{
		return $this->BelongsTo('App\Corporate');
	}

    /**
	* Get the user that owns this corporate user role.
	*/
	public function user()
	{
		return $this->BelongsTo('App\User');
	}


	
}
