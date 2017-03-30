<?php

namespace App\Listeners;

use App\Events\CarTenderDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarTenderDeleted
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
     * @param  CarTenderDeleted  $event
     * @return void
     */
    public function handle(CarTenderDeleted $event)
    {
        //
    }
}
