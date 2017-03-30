<?php

namespace App\Listeners;

use App\Events\CarAuctionBidCancelled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarAuctionBidCancelled
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
     * @param  CarAuctionBidCancelled  $event
     * @return void
     */
    public function handle(CarAuctionBidCancelled $event)
    {
        //
    }
}
