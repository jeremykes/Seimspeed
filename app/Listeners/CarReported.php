<?php

namespace App\Listeners;

use App\Events\CarReported;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarReported
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
     * @param  CarReported  $event
     * @return void
     */
    public function handle(CarReported $event)
    {
        //
    }
}
