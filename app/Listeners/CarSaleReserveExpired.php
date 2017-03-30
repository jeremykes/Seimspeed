<?php

namespace App\Listeners;

use App\Events\CarSaleReserveExpired;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarSaleReserveExpired
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
     * @param  CarSaleReserveExpired  $event
     * @return void
     */
    public function handle(CarSaleReserveExpired $event)
    {
        //
    }
}
