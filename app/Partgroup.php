<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partgroup extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
        'corporate_id', 
        'startdate', 
        'enddate', 
        'published',
        'autopublish', 
        'autounpublish', 
        'autopublishparts', 
        'autounpublishparts', 
        'autoreserveparts',
        'title', 
        'descript', 
    ];

    /**
    * The attributes that should be mutated to dates. *
    * @var array
    */
    protected $dates = [
        'startdate', 
        'enddate'
    ];

    /**
    * Get the corporation that owns this partgroup.
    */
    public function corporate()
    {
        return $this->BelongsTo('App\Corporate');
    }

    /**
    * Get the for sale parts in this group.
    */
    public function sales()
    {
        return $this->hasMany('App\Partsale');
    }
}
