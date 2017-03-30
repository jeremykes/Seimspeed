<?php

namespace App\Listeners;

use App\Events\CarAuctionDateEnded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarAuctionDateEnded
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
     * @param  CarAuctionDateEnded  $event
     * @return void
     */
    public function handle(CarAuctionDateEnded $event)
    {
        //
    }
}
