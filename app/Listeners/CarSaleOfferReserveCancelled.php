<?php

namespace App\Listeners;

use App\Events\CarSaleOfferReserveCancelled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarSaleOfferReserveCancelled
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
     * @param  CarSaleOfferReserveCancelled  $event
     * @return void
     */
    public function handle(CarSaleOfferReserveCancelled $event)
    {
        //
    }
}
