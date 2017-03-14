<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargroup extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'corporate_id', 
        'startdate', 
        'enddate', 
        'title', 
        'type', 
        'published', 
        'autopublish', 
        'autounpublish', 
        'autopublishcars', 
        'autounpublishcars', 
        'autoreservecars', 
        'descript',
    ];

    /**
    * The attributes that should be mutated to dates. *
    * @var array
    */
    protected $dates = [
        'startdate', 
        'enddate',
    ];

    /**
    * Get the corporation that owns this cargroup.
    */
    public function corporate()
    {
        return $this->BelongsTo('App\Corporate');
    }

    /**
    * Get the for auction cars in this group.
    */
    public function auctions()
    {
        return $this->hasMany('App\Carauction');
    }

    /**
    * Get the for tender cars in this group.
    */
    public function tenders()
    {
        return $this->hasMany('App\Cartender');
    }

    /**
    * Get the for sale cars in this group.
    */
    public function sales()
    {
        return $this->hasMany('App\Carsale');
    }

    /**
    * Get the for rental cars in this group.
    */
    public function rentals()
    {
        return $this->hasMany('App\Carrent');
    }
}
