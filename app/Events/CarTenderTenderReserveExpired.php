<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Cartenderreserve;

class CarTenderTenderReserveExpired implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
        
    public $cartenderreserve;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Cartenderrserve $cartenderreserve)
    {
        $this->cartenderreserve = $cartenderreserve;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('public-channel.car.'.$this->cartenderreserve->cartender->car->id);
    }
}
