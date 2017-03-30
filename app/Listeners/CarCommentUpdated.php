<?php

namespace App\Listeners;

use App\Events\CarCommentUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CarCommentUpdated
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
     * @param  CarCommentUpdated  $event
     * @return void
     */
    public function handle(CarCommentUpdated $event)
    {
        //
    }
}
