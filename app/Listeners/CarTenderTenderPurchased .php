<?php

namespace App\Listeners;

use App\Events\CarTenderTenderPurchased ;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarTenderTenderPurchased 
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
     * @param  CarTenderTenderPurchased   $event
     * @return void
     */
    public function handle(CarTenderTenderPurchased  $event)
    {
        //
    }
}
