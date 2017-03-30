<?php

namespace App\Listeners;

use App\Events\CarAuctionAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarAuctionAdded
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
     * @param  CarAuctionAdded  $event
     * @return void
     */
    public function handle(CarAuctionAdded $event)
    {
        //
    }
}
