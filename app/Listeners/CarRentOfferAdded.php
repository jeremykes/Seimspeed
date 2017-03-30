<?php

namespace App\Listeners;

use App\Events\CarRentOfferAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarRentOfferAdded
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
     * @param  CarRentOfferAdded  $event
     * @return void
     */
    public function handle(CarRentOfferAdded $event)
    {
        //
    }
}
