<?php

namespace App\Listeners;

use App\Events\PartTailed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PartTailed
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
     * @param  PartTailed  $event
     * @return void
     */
    public function handle(PartTailed $event)
    {
        //
    }
}
