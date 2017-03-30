<?php

namespace App\Listeners;

use App\Events\CorporateUserUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CorporateUserUpdated
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
     * @param  CorporateUserUpdated  $event
     * @return void
     */
    public function handle(CorporateUserUpdated $event)
    {
        //
    }
}
