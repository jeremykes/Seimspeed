<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrent extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
        'corporate_id',
    	'car_id', 
        'cargroup_id', 
        'startdate',
        'rateperday', 
        'rateperhour', 
        'bondfee', 
        'rentreserveholddays',
        'locked',
        'status', 
        'note', 
    ];

    /**
    * Get the corporation that owns this car.
    */
    public function corporate()
    {
        return $this->BelongsTo('App\Corporate');
    }

    /**
	* Get the car for this rental.
	*/
	public function car()
	{
		return $this->BelongsTo('App\Car');
	}

    /**
    * Get the cargroup for this rental.
    */
    public function cargroup()
    {
        return $this->BelongsTo('App\Cargroup');
    }

    /**
    * Get the offers made to this sale.
    */
    public function offers()
    {
        return $this->hasMany('App\Carrentoffer');
    }

    /**
    * Get the reserves made to this sale.
    */
    public function reserves()
    {
        return $this->hasMany('App\Carrentreserve');
    }

    /**
    * Get the purchases made to this rent.
    */
    public function purchases()
    {
        return $this->hasMany('App\Carrentpurchase');
    }

    /**
    * Get the newsfeeds made to this carrent.
    */
    public function newsfeeds()
    {
        return $this->hasMany('App\Newsfeed');
    }
}
