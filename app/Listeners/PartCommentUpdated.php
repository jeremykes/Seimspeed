<?php

namespace App\Listeners;

use App\Events\PartCommentUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PartCommentUpdated
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
     * @param  PartCommentUpdated  $event
     * @return void
     */
    public function handle(PartCommentUpdated $event)
    {
        //
    }
}
