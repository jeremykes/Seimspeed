<?php

namespace App\Listeners;

use App\Events\CarRentOfferReserved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarRentOfferReserved
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
     * @param  CarRentOfferReserved  $event
     * @return void
     */
    public function handle(CarRentOfferReserved $event)
    {
        //
    }
}
