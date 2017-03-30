<?php

namespace App\Listeners;

use App\Events\PartUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PartUpdated
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
     * @param  PartUpdated  $event
     * @return void
     */
    public function handle(PartUpdated $event)
    {
        //
    }
}
