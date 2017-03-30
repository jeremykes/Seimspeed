<?php

namespace App\Listeners;

use App\Events\CorporateUserDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CorporateUserDeleted
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
     * @param  CorporateUserDeleted  $event
     * @return void
     */
    public function handle(CorporateUserDeleted $event)
    {
        //
    }
}
