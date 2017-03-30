<?php

namespace App\Listeners;

use App\Events\CarTenderAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarTenderAdded
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
     * @param  CarTenderAdded  $event
     * @return void
     */
    public function handle(CarTenderAdded $event)
    {
        //
    }
}
