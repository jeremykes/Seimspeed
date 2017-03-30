<?php

namespace App\Listeners;

use App\Events\CarSaleDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarSaleDeleted
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
     * @param  CarSaleDeleted  $event
     * @return void
     */
    public function handle(CarSaleDeleted $event)
    {
        //
    }
}
