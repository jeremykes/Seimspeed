<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Zizaco\Entrust\Traits\EntrustUserTrait;

use App\Traits\CorporateUserTrait;

class User extends Authenticatable 
{
    use Notifiable;

    use EntrustUserTrait;

    // This is used to check whether a user is part of the Corporation
    use CorporateUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    /**
    * Get the social profile records associated with this user.
    */
    public function socialprofiles()
    {
        return $this->hasMany('App\Socialprofile');
    }

    /**
    * Get the settins record associated with this user.
    */
    public function setting()
    {
        return $this->hasOne('App\Usersetting');
    }

    /**
    * Get the corporateuser record associated with this user.
    */
    public function corporateuser()
    {
        return $this->hasOne('App\Corporateuser');
    }

    /**
    * Get the bids that this user has made.
    */
    public function bids()
    {
        return $this->hasMany('App\Carauctionbid');
    }

    /**
    * Get the bidder records this user is allowed to bid.
    */
    public function bidders()
    {
        return $this->hasMany('App\Carauctionbidder');
    }

    /**
    * Get the tenders made by this user.
    */
    public function tenders()
    {
        return $this->hasMany('App\Cartendertender');
    }
    
    /**
    * Get the tender records this user is allowed to tender.
    */
    public function tenderers()
    {
        return $this->hasMany('App\Cartendertenderer');
    }

    /**
    * Get the car sale offers made by this user.
    */
    public function carsaleoffers()
    {
        return $this->hasMany('App\Carsaleoffer');
    }

    /**
    * Get the rent offers made by this user.
    */
    public function rentoffers()
    {
        return $this->hasMany('App\Carrentoffer');
    }




    /**
    * Get the car comments for this user.
    */
    public function carcomments()
    {
        return $this->hasMany('App\Carcomment');
    }
    
    /**
    * Get the carlikes for this user.
    */
    public function carlikes()
    {
        return $this->hasMany('App\Carlike');
    }

    /**
    * Get the cartails for this user.
    */
    public function cartails()
    {
        return $this->hasMany('App\Cartail');
    }

    /**
    * Get the car reports for this user.
    */
    public function carreports()
    {
        return $this->hasMany('App\Carreport');
    }


    

    /**
    * Get the partoffers made by this user.
    */
    public function partsaleoffers()
    {
        return $this->hasMany('App\Partsaleoffer');
    }




    /**
    * Get the part comments for this user.
    */
    public function partcomments()
    {
        return $this->hasMany('App\Partcomment');
    }

    /**
    * Get the partlikes for this user.
    */
    public function partlikes()
    {
        return $this->hasMany('App\Partlike');
    }

    /**
    * Get the parttails for this user.
    */
    public function parttails()
    {
        return $this->hasMany('App\Parttail');
    }

    /**
    * Get the part reports for this user.
    */
    public function partreports()
    {
        return $this->hasMany('App\Partreport');
    }




    /**
    * Get the corporate reports for this user.
    */
    public function corporatereports()
    {
        return $this->hasMany('App\Corporatereport');
    }

    /**
    * Get the corporate ratings for this user.
    */
    public function corporateratings()
    {
        return $this->hasMany('App\Corporaterating');
    }

    /**
    * Get the corporate tails for this user.
    */
    public function corporatetails()
    {
        return $this->hasMany('App\Corporatetail');
    }




    /**
    * Get the messages made by this user.
    */
    public function sendingmessages()
    {
        return $this->hasMany('App\Message', 'user_id_sending');
    }

    /**
    * Get the messages received by this user.
    */
    public function receivingmessages()
    {
        return $this->hasMany('App\Message', 'user_id_receiving');
    }




    // /**
    // * Get the notifications for this user.
    // */
    // public function notifications()
    // {
    //     return $this->hasMany('App\Notification');
    // }




    /**
    * Get the reports made by this user.
    */
    public function reportings()
    {
        return $this->hasMany('App\Userreport', 'reporting_user_id');
    }

    /**
    * Get the reports made against this user.
    */
    public function reports()
    {
        return $this->hasMany('App\Userreport', 'report_user_id');
    }




    /**
    * Get the notificable settings for this user.
    */
    public function notificables()
    {
        return $this->hasMany('App\Notificable');
    }
}
