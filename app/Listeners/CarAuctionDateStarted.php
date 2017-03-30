<?php

namespace App\Listeners;

use App\Events\CarAuctionDateStarted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarAuctionDateStarted
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
     * @param  CarAuctionDateStarted  $event
     * @return void
     */
    public function handle(CarAuctionDateStarted $event)
    {
        //
    }
}
