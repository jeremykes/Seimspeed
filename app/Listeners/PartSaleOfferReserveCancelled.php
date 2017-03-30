<?php

namespace App\Listeners;

use App\Events\PartSaleOfferReserveCancelled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PartSaleOfferReserveCancelled
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
     * @param  PartSaleOfferReserveCancelled  $event
     * @return void
     */
    public function handle(PartSaleOfferReserveCancelled $event)
    {
        //
    }
}
