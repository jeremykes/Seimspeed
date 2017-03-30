<?php

namespace App\Listeners;

use App\Events\PartSaleClosed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PartSaleClosed
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
     * @param  PartSaleClosed  $event
     * @return void
     */
    public function handle(PartSaleClosed $event)
    {
        //
    }
}
