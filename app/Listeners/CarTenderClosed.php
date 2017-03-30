<?php

namespace App\Listeners;

use App\Events\CarTenderClosed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarTenderClosed
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
     * @param  CarTenderClosed  $event
     * @return void
     */
    public function handle(CarTenderClosed $event)
    {
        //
    }
}
