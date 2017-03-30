<?php

namespace App\Listeners;

use App\Events\CorporateDeactivated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CorporateDeactivated
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
     * @param  CorporateDeactivated  $event
     * @return void
     */
    public function handle(CorporateDeactivated $event)
    {
        //
    }
}
