<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

// Do this first
use App\User;
use App\Corporate;
use App\Corporaterating;

class CorporateRated implements ShouldBroadcast //DO this 2nd
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // Do this 3rd
    public $user;
    public $corporate;
    public $corporaterating;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    // Do this 4th
    public function __construct(User $user, Corporate $corporate, Corporaterating $corporaterating)
    {
        // Do this 5th
        $this->user = $user;
        $this->corporate = $corporate;
        $this->corporaterating = $corporaterating;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        // Do this last
        return new PrivateChannel('public-channel');
    }
}
