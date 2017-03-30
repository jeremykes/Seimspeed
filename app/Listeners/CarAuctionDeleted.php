<?php

namespace App\Listeners;

use App\Events\CarAuctionDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarAuctionDeleted
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
     * @param  CarAuctionDeleted  $event
     * @return void
     */
    public function handle(CarAuctionDeleted $event)
    {
        //
    }
}
