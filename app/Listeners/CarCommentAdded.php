<?php

namespace App\Listeners;

use App\Events\CarCommentAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarCommentAdded
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
     * @param  CarCommentAdded  $event
     * @return void
     */
    public function handle(CarCommentAdded $event)
    {
        //
    }
}
