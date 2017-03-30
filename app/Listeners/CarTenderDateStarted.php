<?php

namespace App\Listeners;

use App\Events\CarTenderDateStarted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarTenderDateStarted
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
     * @param  CarTenderDateStarted  $event
     * @return void
     */
    public function handle(CarTenderDateStarted $event)
    {
        //
    }
}
