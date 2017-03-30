<?php

namespace App\Listeners;

use App\Events\CarRentOfferCancelled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarRentOfferCancelled
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
     * @param  CarRentOfferCancelled  $event
     * @return void
     */
    public function handle(CarRentOfferCancelled $event)
    {
        //
    }
}
