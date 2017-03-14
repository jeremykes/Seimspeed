<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corporate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'address', 
        'phone', 
        'descrip', 
        'logo_url', 
        'banner_url', 
    ];

    /**
    * The attributes that should be mutated to dates. *
    * @var array
    */
    protected $dates = [
        'subscriptionexpires',
    ];

    /**
    * Get the settins record associated with this corporate.
    */
    public function setting()
    {
        return $this->hasOne('App\Corporatesetting');
    }

    /**
    * Get the corporate users associated with this corporation.
    */
    public function corporateusers()
    {
        return $this->hasMany('App\Corporateuser');
    }

    /**
    * Get the cars for this corporation.
    */
    public function cars()
    {
        return $this->hasMany('App\Car');
    }

    /**
    * Get the car groups associated with this corporation.
    */
    public function cargroups()
    {
        return $this->hasMany('App\Cargroup');
    }

    /**
    * Get the car auctions for this corporation.
    */
    public function auctions()
    {
        return $this->hasMany('App\Carauction');
    }

    /**
    * Get the car tenders for this corporation.
    */
    public function tenders()
    {
        return $this->hasMany('App\Cartender');
    }

    /**
    * Get the car sales for this corporation.
    */
    public function carsales()
    {
        return $this->hasMany('App\Carsale');
    }

    /**
    * Get the car rentals for this corporation.
    */
    public function rents()
    {
        return $this->hasMany('App\Carrent');
    }
    


    /**
    * Get the parts for this corporation.
    */
    public function parts()
    {
        return $this->hasMany('App\Part');
    }
    
    /**
    * Get the part groups associated with this corporation.
    */
    public function partgroups()
    {
        return $this->hasMany('App\Partgroup');
    }

    /**
    * Get the part sales for this corporation.
    */
    public function partsales()
    {
        return $this->hasMany('App\Partsale');
    }

    /**
    * Get the reports for this corporation.
    */
    public function reports()
    {
        return $this->hasMany('App\Corporatereport');
    }

    /**
    * Get the corporate ratings associated with this corporation.
    */
    public function ratings()
    {
        return $this->hasMany('App\Corporaterating');
    }

    /**
    * Get the corporate tails for this corporation.
    */
    public function tails()
    {
        return $this->hasMany('App\Corporatetail');
    }

    /**
    * Get the subscription record associated with this corporation.
    */
    public function subscription()
    {
        return $this->hasOne('App\Subscription');
    }
}
