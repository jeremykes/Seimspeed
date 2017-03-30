<?php

namespace App\Listeners;

use App\Events\CarSaleOfferPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarSaleOfferPurchased
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
     * @param  CarSaleOfferPurchased  $event
     * @return void
     */
    public function handle(CarSaleOfferPurchased $event)
    {
        //
    }
}
