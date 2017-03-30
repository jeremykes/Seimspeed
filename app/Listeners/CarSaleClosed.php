<?php

namespace App\Listeners;

use App\Events\CarSaleClosed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarSaleClosed
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
     * @param  CarSaleClosed  $event
     * @return void
     */
    public function handle(CarSaleClosed $event)
    {
        //
    }
}
