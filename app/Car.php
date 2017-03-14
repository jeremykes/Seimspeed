<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
    	'corporate_id', 
        'datebought', 
        'dateregistered', 
        'weight', 
        'plates', 
        'color', 
        'fueltype', 
        'transmissiontype', 
        '2wd4wd', 
        'steeringside', 
        'make' , 
        'model', 
        'bodytype', 
        'status', 
        'note',
        'physicallocation', 
        'ingroup', 
        'published', 
    ];

    /**
    * The attributes that should be mutated to dates. *
    * @var array
    */
    protected $dates = [
    	'datebought', 
        'dateregistered', 
    ];

    /**
	* Get the corporation that owns this car.
	*/
	public function corporate()
	{
		return $this->BelongsTo('App\Corporate');
	}

    /**
    * Get the auction records of this car.
    */
    public function auction()
    {
        return $this->hasOne('App\Carauction');
    }

    /**
    * Get the tender records of this car.
    */
    public function tender()
    {
        return $this->hasOne('App\Cartender');
    }

    /**
    * Get the sale.
    */
    public function sale()
    {
        return $this->hasOne('App\Carsale');
    }
    
    /**
    * Get the rent.
    */
    public function rent()
    {
        return $this->hasOne('App\Carrent');
    }





    /**
    * Get the comments for this car.
    */
    public function comments()
    {
        return $this->hasMany('App\Carcomment');
    }
    
    /**
    * Get the likes for this car.
    */
    public function likes()
    {
        return $this->hasMany('App\Carlike');
    }
	
    /**
    * Get the tails for this car.
    */
    public function tails()
    {
        return $this->hasMany('App\Cartail');
    }
    
    /**
    * Get the images for this car.
    */
    public function images()
    {
        return $this->hasMany('App\Carimage');
    }
    
    /**
    * Get the reports for this car.
    */
    public function reports()
    {
        return $this->hasMany('App\Carreport');
    }
}
