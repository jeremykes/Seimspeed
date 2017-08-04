<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Carrentoffer;

class CarRentOfferReserveCancelled implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $carrentoffer;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Carrentoffer $carrentoffer)
    {
        $this->currentoffer = $carrentoffer;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('public-channel.car.'.$this->carrentoffer->carrent->car->id);
    }
}
