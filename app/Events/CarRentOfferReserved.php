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
use App\Car;
use App\Carrentoffer;

class CarRentOfferReserved implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

        public $user;
        public $car;
        public $carrentoffer;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Car $car, Carrentoffer $carrentoffer)
    {
        $this->user = $user;
        $this->car = $car;
        $this->carrentoffer = $carrentoffer;
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
