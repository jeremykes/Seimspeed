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
use App\Car;
use App\Carimage;

class CarImageUpdated  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $corporate;
    public $car;
    public $carimage;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Corporate $corporate, Car $car, Carimage $carimage)
    {
        $this->user = $user;
        $this->corporate = $corporate;
        $this->car = $car;
        $this->carimage = $carimage;
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
