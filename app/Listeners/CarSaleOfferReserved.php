<?php

namespace App\Listeners;

use App\Events\CarSaleOfferReserved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarSaleOfferReserved
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
     * @param  CarSaleOfferReserved  $event
     * @return void
     */
    public function handle(CarSaleOfferReserved $event)
    {
        //
    }
}
