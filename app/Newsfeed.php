<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsfeed extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'carsale_id', 
        'carrent_id', 
        'cartender_id', 
        'carauction_id', 
        'partsale_id', 
    ];

    /**
    * Get the carsale record associated with this newsfeed.
    */
    public function carsale()
    {
        return $this->hasOne('App\Carsale');
    }

    /**
    * Get the carrent record associated with this newsfeed.
    */
    public function rent()
    {
        return $this->hasOne('App\Carrent');
    }

    /**
    * Get the cartender record associated with this newsfeed.
    */
    public function tender()
    {
        return $this->hasOne('App\Cartender');
    }

    /**
    * Get the carauction record associated with this newsfeed.
    */
    public function auction()
    {
        return $this->hasOne('App\Carauction');
    }

    /**
    * Get the partsale record associated with this newsfeed.
    */
    public function partsale()
    {
        return $this->hasOne('App\Partsale');
    }
}
