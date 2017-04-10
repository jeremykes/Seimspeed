<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\User;
use App\Part;
use App\Partgroup;
use App\Partcomment;

class PartCommentAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

        public $user;
        public $part;
        public $partgrouup;
        public $partcomment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Part $part, Partgroup $partgroup, Partcomment $partcomment)
    {
        $this->user = $user;
        $this->part = $part;
        $this->partgroup = $partgroup;
        $this->partcomment = $partcomment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('public-channel');
    }
}
