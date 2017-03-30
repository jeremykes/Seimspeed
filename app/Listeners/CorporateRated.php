<?php

namespace App\Listeners;

use App\Events\CorporateRated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CorporateRated
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
     * @param  CorporateRated  $event
     * @return void
     */
    public function handle(CorporateRated $event)
    {
        //
    }
}
