<?php

namespace App\Listeners;

use App\Events\PartSaleOfferReserved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PartSaleOfferReserved
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
     * @param  PartSaleOfferReserved  $event
     * @return void
     */
    public function handle(PartSaleOfferReserved $event)
    {
        //
    }
}
