<?php

namespace App\Listeners;

use App\Events\PartSaleOfferAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PartSaleOfferAdded
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
     * @param  PartSaleOfferAdded  $event
     * @return void
     */
    public function handle(PartSaleOfferAdded $event)
    {
        //
    }
}
