<?php

namespace App\Listeners;

use App\Events\PartCommentAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PartCommentAdded
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
     * @param  PartCommentAdded  $event
     * @return void
     */
    public function handle(PartCommentAdded $event)
    {
        //
    }
}
