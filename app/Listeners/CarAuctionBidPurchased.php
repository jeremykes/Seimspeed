<?php

namespace App\Listeners;

use App\Events\CarAuctionBidPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarAuctionBidPurchased
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
     * @param  CarAuctionBidPurchased  $event
     * @return void
     */
    public function handle(CarAuctionBidPurchased $event)
    {
        //
    }
}
