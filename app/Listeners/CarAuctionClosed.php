<?php

namespace App\Listeners;

use App\Events\CarAuctionClosed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarAuctionClosed
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
     * @param  CarAuctionClosed  $event
     * @return void
     */
    public function handle(CarAuctionClosed $event)
    {
        //
    }
}
