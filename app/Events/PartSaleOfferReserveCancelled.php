<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PartSaleOfferReserveCancelled implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $partsalereserve_id;
    public $part_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($partsalereserve_id, $part_id)
    {
        $this->partsalereserve_id = $partsalereserve_id;
        $this->part_id = $part_id;  
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('public-channel.part.'.$this->part_id);
    }
}
