<?php

namespace App\Listeners;

use App\Events\CarUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarUpdated
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
     * @param  CarUpdated  $event
     * @return void
     */
    public function handle(CarUpdated $event)
    {
        //
    }
}
