<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    /**
	* The attributes that are mass assignable. *
	* @var array
	*/
	protected $fillable = [
        'corporate_id',
        'ingroup',
        'published', 
    	'name', 
        'serialnumber', 
        'descript', 
        'status', 
        'physicallocation',
        'note', 
    ];

    /**
	* Get the corporation who owns this carpart.
	*/
	public function corporate()
	{
		return $this->BelongsTo('App\Corporate');
	}

    /**
    * Get the sale.
    */
    public function sale()
    {
        return $this->hasOne('App\Partsale');
    }

    /**
    * Get the comments for this part.
    */
    public function comments()
    {
        return $this->hasMany('App\Partcomment');
    }

    /**
    * Get the likes for this part.
    */
    public function likes()
    {
        return $this->hasMany('App\Partlike');
    }

    /**
    * Get the tails for this part.
    */
    public function tails()
    {
        return $this->hasMany('App\Parttail');
    }
    
    /**
    * Get the images for this part.
    */
    public function images()
    {
        return $this->hasMany('App\Partimage');
    }

    /**
    * Get the reports for this part.
    */
    public function reports()
    {
        return $this->hasMany('App\Partreport');
    }
}
