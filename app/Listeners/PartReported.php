<?php

namespace App\Listeners;

use App\Events\PartReported;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PartReported
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
     * @param  PartReported  $event
     * @return void
     */
    public function handle(PartReported $event)
    {
        //
    }
}
