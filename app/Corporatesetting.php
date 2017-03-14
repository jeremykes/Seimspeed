<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corporatesetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'corporate_id',
        'region', 
        'lang',
    ];

    /**
    * Get the corporate record associated with this settings.
    */
    public function corporate()
    {
        return $this->BelongsTo('App\Corporate');
    }
}
