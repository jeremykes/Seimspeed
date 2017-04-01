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
use App\Corporateuser;

class CorporateUserUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $corporate;
    public $corporateuser;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Corporate $corporate, Corporateuser $corporateuser)
    {
        $this->user = $user;
        $this->corporate = $corporate;
        $this->corporateuser = $corporateuser;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.User.'.$this->user->id);
    }
}
