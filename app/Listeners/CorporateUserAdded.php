<?php

namespace App\Listeners;

use App\Events\CorporateUserAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CorporateUserAdded
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
     * @param  CorporateUserAdded  $event
     * @return void
     */
    public function handle(CorporateUserAdded $event)
    {
        //
    }
}
