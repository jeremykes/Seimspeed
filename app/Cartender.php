<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cartender extends Model
{
    use SoftDeletes;
    
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
        'corporate_id', 
    	'car_id', 
        'cargroup_id', 
        'startdate', 
        'enddate', 
        'signuprequired', 
        'signupfee', 
        'tenderreserveholddays',
        'status', 
        'locked',
        'note', 
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
    * Get the corporate for this tender.
    */
    public function corporate()
    {
        return $this->BelongsTo('App\Corporate');
    }

    /**
	* Get the car that this tender record belongs to.
	*/
	public function car()
	{
		return $this->BelongsTo('App\Car');
	}

    /**
    * Get the cargroup for this tender.
    */
    public function group()
    {
        return $this->BelongsTo('App\Cargroup');
    }

    /**
    * Get the tenders that have been made to this tender.
    */
    public function tenders()
    {
        return $this->hasMany('App\Cartendertender');
    }

    /**
    * Get the purchase made to this tender.
    */
    public function purchase()
    {
        return $this->hasOne('App\Cartenderpurchase');
    }

    /**
    * Get the reserves that have been made to this tender.
    */
    public function reserves()
    {
        return $this->hasMany('App\Cartenderreserve');
    }

    /**
    * Get the tenderers allowed to this tender.
    */
    public function tenderers()
    {
        return $this->hasMany('App\Cartendertenderer');
    }

	/**
    * Get the newsfeeds made to this cartender.
    */
    public function newsfeeds()
    {
        return $this->hasMany('App\Newsfeed');
    }
}
