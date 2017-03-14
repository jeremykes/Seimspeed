<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    /**
     * The attributes that arent mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'name', 
        'descrip', 
        'monthlyfee', 
        'carsallowed', 
        'partsallowed', 
    ];

    /**
    * Get the corporations with this subscription.
    */
    public function corporates()
    {
        return $this->hasMany('App\Corporate');
    }    
}
