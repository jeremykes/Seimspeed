<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Carauctionreserve;

class CarAuctionBidReserved implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $carauctionreserve;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Carauctionreserve $carauctionreserve)
    {
        $this->carauctionreserve = $carauctionreserve;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('public-channel.car.'.$this->carauctionreserve->carauctionbid->carauction->car->id);
    }
}
