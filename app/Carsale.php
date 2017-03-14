<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carsale extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
        'corporate_id', 
    	'car_id', 
        'cargroup_id',
        'price', 
        'startdate',
        'salereserveholddays',
        'negotiable', 
        'locked',
        'status', 
        'note', 
    ];

    /**
    * The attributes that should be mutated to dates. *
    * @var array
    */
    protected $dates = ['startdate'];

    /**
    * Get the corporation that owns this car sale.
    */
    public function corporate()
    {
        return $this->BelongsTo('App\Corporate');
    }

    /**
	* Get the car for this sale.
	*/
	public function car()
	{
		return $this->BelongsTo('App\Car');
	}

	/**
	* Get the cargroup for this sale.
	*/
	public function group()
	{
		return $this->BelongsTo('App\Cargroup');
	}

    /**
    * Get the offers made to this sale.
    */
    public function offers()
    {
        return $this->hasMany('App\Carsaleoffer');
    }
    
    /**
    * Get the reserves made to this sale.
    */
    public function reserves()
    {
        return $this->hasMany('App\Carsalereserve');
    }

    /**
    * Get the purchase made to this sale.
    */
    public function purchase()
    {
        return $this->hasOne('App\Carsalepurchase');
    }

    /**
    * Get the newsfeeds made to this carsale.
    */
    public function newsfeeds()
    {
        return $this->hasMany('App\Newsfeed');
    }
}
