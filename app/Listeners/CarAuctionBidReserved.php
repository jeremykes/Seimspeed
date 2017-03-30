<?php

namespace App\Listeners;

use App\Events\CarAuctionBidReserved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarAuctionBidReserved
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
     * @param  CarAuctionBidReserved  $event
     * @return void
     */
    public function handle(CarAuctionBidReserved $event)
    {
        //
    }
}
