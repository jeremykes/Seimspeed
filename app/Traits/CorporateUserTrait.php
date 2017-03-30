<?php 

namespace App\Traits;

/**
 * Created by Jeremy Palme,
 * This trait checks to see if a user is part of a Corporate Account.
 *
 */

trait CorporateUserTrait
{

	public function isCorporateUser($corporate)
	{
	    if ($this->corporateuser && ($corporate->id == $this->corporateuser->corporate->id)) { 
	        return true;
	    }
	    else {  
	        return false;
	    }
	}
}
