<?php

namespace App\Listeners;

use App\Events\CarLiked;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarLiked
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
     * @param  CarLiked  $event
     * @return void
     */
    public function handle(CarLiked $event)
    {
        //
    }
}
