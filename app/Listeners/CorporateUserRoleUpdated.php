<?php

namespace App\Listeners;

use App\Events\CorporateUserRoleUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CorporateUserRoleUpdated
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
     * @param  CorporateUserRoleUpdated  $event
     * @return void
     */
    public function handle(CorporateUserRoleUpdated $event)
    {
        //
    }
}
