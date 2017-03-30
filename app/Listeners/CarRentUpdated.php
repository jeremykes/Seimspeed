<?php

namespace App\Listeners;

use App\Events\CarRentUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarRentUpdated
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
     * @param  CarRentUpdated  $event
     * @return void
     */
    public function handle(CarRentUpdated $event)
    {
        //
    }
}
