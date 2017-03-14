<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carauction extends Model
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
        'enddate', 
        'startbidprice', 
        'signuprequired', 
        'signupfee',  
        'auctionreserveholddays', 
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
    * Get the corporation that owns this car.
    */
    public function corporate()
    {
        return $this->BelongsTo('App\Corporate');
    }

    /**
    * Get the car for this auction.
    */
    public function car()
    {
        return $this->BelongsTo('App\Car');
    }

    /**
    * Get the cargroup for this auction.
    */
    public function group()
    {
        return $this->BelongsTo('App\Cargroup');
    }

    /**
    * Get the bids that have been made to this auction.
    */
    public function bids()
    {
        return $this->hasMany('App\Carauctionbid');
    }

    /**
    * Get the reserves that have been made to this auction.
    */
    public function reserves()
    {
        return $this->hasMany('App\Carauctionreserve');
    }

    /**
    * Get the purchase made to this sale.
    */
    public function purchase()
    {
        return $this->hasOne('App\Carauctionpurchase');
    }

    /**
    * Get the bidders allowed to this auction.
    */
    public function bidders()
    {
        return $this->hasMany('App\Carauctionbidder');
    }

    /**
    * Get the newsfeeds made to this carauction.
    */
    public function newsfeeds()
    {
        return $this->hasMany('App\Newsfeed');
    }
}
