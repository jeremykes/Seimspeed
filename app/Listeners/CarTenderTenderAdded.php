<?php

namespace App\Listeners;

use App\Events\CarTenderTenderAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarTenderTenderAdded
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
     * @param  CarTenderTenderAdded  $event
     * @return void
     */
    public function handle(CarTenderTenderAdded $event)
    {
        //
    }
}
