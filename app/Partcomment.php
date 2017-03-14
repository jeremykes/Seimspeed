<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partcomment extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'parent_commentid', 
    	'user_id', 
    	'part_id', 
    	'comment',
    ];

    /**
	* Get the user making this comment.
	*/
	public function user()
	{
		return $this->BelongsTo('App\User');
	}

	/**
	* Get the part that owns this comment.
	*/
	public function part()
	{
		return $this->BelongsTo('App\Part');
	}
}
