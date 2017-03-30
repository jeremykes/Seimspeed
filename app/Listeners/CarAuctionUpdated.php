<?php

namespace App\Listeners;

use App\Events\CarAuctionUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarAuctionUpdated
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
     * @param  CarAuctionUpdated  $event
     * @return void
     */
    public function handle(CarAuctionUpdated $event)
    {
        //
    }
}
