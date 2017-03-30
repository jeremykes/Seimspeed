<?php

namespace App\Listeners;

use App\Events\CarRentPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarRentPurchased
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
     * @param  CarRentPurchased  $event
     * @return void
     */
    public function handle(CarRentPurchased $event)
    {
        //
    }
}
