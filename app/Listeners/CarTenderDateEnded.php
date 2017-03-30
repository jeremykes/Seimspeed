<?php

namespace App\Listeners;

use App\Events\CarTenderDateEnded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarTenderDateEnded
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
     * @param  CarTenderDateEnded  $event
     * @return void
     */
    public function handle(CarTenderDateEnded $event)
    {
        //
    }
}
