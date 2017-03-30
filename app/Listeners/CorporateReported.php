<?php

namespace App\Listeners;

use App\Events\CorporateReported;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CorporateReported
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
     * @param  CorporateReported  $event
     * @return void
     */
    public function handle(CorporateReported $event)
    {
        //
    }
}
