<?php

namespace App\Listeners;

use App\Events\CarRentClosed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarRentClosed
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
     * @param  CarRentClosed  $event
     * @return void
     */
    public function handle(CarRentClosed $event)
    {
        //
    }
}
