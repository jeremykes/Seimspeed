<?php

namespace App\Listeners;

use App\Events\CorporateUserRoleAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CorporateUserRoleAdded
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CorporateUserRoleAdded  $event
     * @return void
     */
    public function handle(CorporateUserRoleAdded $event)
    {
        //
    }
}
