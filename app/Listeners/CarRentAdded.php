<?php

namespace App\Listeners;

use App\Events\CarRentAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarRentAdded
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
     * @param  CarRentAdded  $event
     * @return void
     */
    public function handle(CarRentAdded $event)
    {
        //
    }
}
