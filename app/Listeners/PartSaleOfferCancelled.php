<?php

namespace App\Listeners;

use App\Events\PartSaleOfferCancelled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PartSaleOfferCancelled
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
     * @param  PartSaleOfferCancelled  $event
     * @return void
     */
    public function handle(PartSaleOfferCancelled $event)
    {
        //
    }
}
