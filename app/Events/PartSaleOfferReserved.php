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
use App\Partsale;
use App\Partsaleoffer;
use App\Partsalereserve;

class PartSaleOfferReserved implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

        public $user;
        public $part;
        public $partsale;
        public $partsaleoffer;
        public $partsalereserve;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Part $part, Partsale $partsale, Partsaleoffer $partsaleoffer, Partsalereserve $partsalereserve)
    {
        $this->user = $user;
        $this->part = $part;
        $this->partsale = $partsale;
        $this->partsaleoffer = $partsaleoffer;    
        $this->partsalereserve = $partsalereserve;
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
