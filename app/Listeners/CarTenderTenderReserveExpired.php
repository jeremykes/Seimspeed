<?php

namespace App\Listeners;

use App\Events\CarTenderTenderReserveExpired;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarTenderTenderReserveExpired
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
     * @param  CarTenderTenderReserveExpired  $event
     * @return void
     */
    public function handle(CarTenderTenderReserveExpired $event)
    {
        //
    }
}
