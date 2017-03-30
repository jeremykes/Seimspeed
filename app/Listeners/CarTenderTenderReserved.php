<?php

namespace App\Listeners;

use App\Events\CarTenderTenderReserved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarTenderTenderReserved
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
     * @param  CarTenderTenderReserved  $event
     * @return void
     */
    public function handle(CarTenderTenderReserved $event)
    {
        //
    }
}
