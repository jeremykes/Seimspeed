<?php

namespace App\Listeners;

use App\Events\PartSaleReserveExpired;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PartSaleReserveExpired
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
     * @param  PartSaleReserveExpired  $event
     * @return void
     */
    public function handle(PartSaleReserveExpired $event)
    {
        //
    }
}
