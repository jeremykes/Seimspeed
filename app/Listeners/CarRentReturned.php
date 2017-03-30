<?php

namespace App\Listeners;

use App\Events\CarRentReturned;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarRentReturned
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
     * @param  CarRentReturned  $event
     * @return void
     */
    public function handle(CarRentReturned $event)
    {
        //
    }
}
