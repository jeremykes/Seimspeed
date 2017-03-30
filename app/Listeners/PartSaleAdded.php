<?php

namespace App\Listeners;

use App\Events\PartSaleAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PartSaleAdded
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
     * @param  PartSaleAdded  $event
     * @return void
     */
    public function handle(PartSaleAdded $event)
    {
        //
    }
}
