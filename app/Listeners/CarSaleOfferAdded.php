<?php

namespace App\Listeners;

use App\Events\CarSaleOfferAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarSaleOfferAdded
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
     * @param  CarSaleOfferAdded  $event
     * @return void
     */
    public function handle(CarSaleOfferAdded $event)
    {
        //
    }
}
