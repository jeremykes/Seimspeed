<?php

namespace App\Listeners;

use App\Events\CarRentReserveExpired;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarRentReserveExpired
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
     * @param  CarRentReserveExpired  $event
     * @return void
     */
    public function handle(CarRentReserveExpired $event)
    {
        //
    }
}
