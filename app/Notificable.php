<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificable extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
        'model_id',
        'model_name',
        'use_id',
    ];
}
