<?php

namespace App\Listeners;

use App\Events\CarSaleOfferCancelled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarSaleOfferCancelled
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
     * @param  CarSaleOfferCancelled  $event
     * @return void
     */
    public function handle(CarSaleOfferCancelled $event)
    {
        //
    }
}
