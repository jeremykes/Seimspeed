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
use App\Carrent;
use App\Carrentoffer;

class CarRentOfferAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $car;
    public $carrent;
    public $carrentoffer;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Car $car, Carrent $carrent, Carrentoffer $carrentoffer)
    {
        $this->user = $user;
        $this->car = $car;
        $this->carrent = $current;
        $this->currentoffer = $carrentoffer;
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
