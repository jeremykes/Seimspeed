<?php

namespace App\Listeners;

use App\Events\CarTailed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarTailed
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
     * @param  CarTailed  $event
     * @return void
     */
    public function handle(CarTailed $event)
    {
        //
    }
}
