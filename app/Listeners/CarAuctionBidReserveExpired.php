<?php

namespace App\Listeners;

use App\Events\CarAuctionBidReserveExpired;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarAuctionBidReserveExpired
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
     * @param  CarAuctionBidReserveExpired  $event
     * @return void
     */
    public function handle(CarAuctionBidReserveExpired $event)
    {
        //
    }
}
