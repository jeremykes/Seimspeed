<?php

namespace App\Listeners;

use App\Events\UserReported;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserReported
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
     * @param  UserReported  $event
     * @return void
     */
    public function handle(UserReported $event)
    {
        //
    }
}
