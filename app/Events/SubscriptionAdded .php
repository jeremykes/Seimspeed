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
use App\Corporate;
use App\Subscription;

class SubscriptionAdded  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $corporate;
    public $subscription;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Corporate $corporate, Subscription $subscription)
    {
        $this->user = $user;
        $this->corporate = $corporate;
        $this->subscription = $subscription;
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
