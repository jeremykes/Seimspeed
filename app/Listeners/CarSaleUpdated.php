<?php

namespace App\Listeners;

use App\Events\CarSaleUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarSaleUpdated
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
     * @param  CarSaleUpdated  $event
     * @return void
     */
    public function handle(CarSaleUpdated $event)
    {
        //
    }
}
