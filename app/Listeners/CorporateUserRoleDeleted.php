<?php

namespace App\Listeners;

use App\Events\CorporateUserRoleDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CorporateUserRoleDeleted
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
     * @param  CorporateUserRoleDeleted  $event
     * @return void
     */
    public function handle(CorporateUserRoleDeleted $event)
    {
        //
    }
}
