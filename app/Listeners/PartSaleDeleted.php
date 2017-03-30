<?php

namespace App\Listeners;

use App\Events\PartSaleDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PartSaleDeleted
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
     * @param  PartSaleDeleted  $event
     * @return void
     */
    public function handle(PartSaleDeleted $event)
    {
        //
    }
}
