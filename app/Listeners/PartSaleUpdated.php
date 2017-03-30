<?php

namespace App\Listeners;

use App\Events\PartSaleUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PartSaleUpdated
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
     * @param  PartSaleUpdated  $event
     * @return void
     */
    public function handle(PartSaleUpdated $event)
    {
        //
    }
}
