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
use App\Cartender;
use App\Cartendertender;
use App\Cartenderreserve;

class CarTenderTenderReserved implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

        public $user;
        public $car;
        public $cartender;
        public $cartendertender;
        public $cartenderreserve;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Car $car, Cartender $cartender, Cartendertender $cartendertender, Cartenderreserve $cartenderreserve)
    {
        $this->user = $user;
        $this->car = $car;
        $this->cartender = $cartender
        $this->cartendertender = $cartendertender;
        $this->cartenderreserve = $cartenderreserve;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('private-channel');
    }
}
