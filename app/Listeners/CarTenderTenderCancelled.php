<?php

namespace App\Listeners;

use App\Events\CarTenderTenderCancelled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarTenderTenderCancelled
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
     * @param  CarTenderTenderCancelled  $event
     * @return void
     */
    public function handle(CarTenderTenderCancelled $event)
    {
        //
    }
}
