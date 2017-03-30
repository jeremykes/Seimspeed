<?php

namespace App\Listeners;

use App\Events\CarTenderUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarTenderUpdated
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
     * @param  CarTenderUpdated  $event
     * @return void
     */
    public function handle(CarTenderUpdated $event)
    {
        //
    }
}
