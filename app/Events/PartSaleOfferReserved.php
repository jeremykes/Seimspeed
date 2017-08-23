<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Partsalereserve;

class PartSaleOfferReserved implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $partsalereserve;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Partsalereserve $partsalereserve)
    {
        $this->partsalereserve = $partsalereserve;    
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('public-channel.part.'.$this->partsalereserve->partsaleoffer->partsale->part->id);
    }
}
