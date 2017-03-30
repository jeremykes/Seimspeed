<?php

namespace App\Listeners;

use App\Events\CarSaleAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarSaleAdded
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
     * @param  CarSaleAdded  $event
     * @return void
     */
    public function handle(CarSaleAdded $event)
    {
        //
    }
}
