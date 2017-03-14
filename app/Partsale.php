<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partsale extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
        'corporate_id',
    	'part_id',
        'partgroup_id', 
        'startdate', 
        'price', 
        'negotiable', 
        'locked',
        'salereserveholddays',
        'status', 
        'note', 
    ];

    /**
    * The attributes that should be mutated to dates. *
    * @var array
    */
    protected $dates = [
        'startdate', 
    ];

    /**
	* Get the corporation who owns this carpart sale.
	*/
	public function corporate()
	{
		return $this->BelongsTo('App\Corporate');
	}


    /**
	* Get the part for this sale.
	*/
	public function part()
	{
		return $this->BelongsTo('App\Part');
	}

	/**
	* Get the part group for this sale.
	*/
	public function group()
	{
		return $this->BelongsTo('App\Partgroup');
	}

    /**
    * Get the offers made to this sale.
    */
    public function offers()
    {
        return $this->hasMany('App\Partsaleoffer');
    }

    /**
    * Get the reserves made to this sale.
    */
    public function reserves()
    {
        return $this->hasMany('App\Partsalereserve');
    }

    /**
    * Get the purchase made to this sale.
    */
    public function purchase()
    {
        return $this->hasOne('App\Partsalepurchase');
    }

    /**
    * Get the newsfeeds made to this partsale.
    */
    public function newsfeeds()
    {
        return $this->hasMany('App\Newsfeed');
    }
}
