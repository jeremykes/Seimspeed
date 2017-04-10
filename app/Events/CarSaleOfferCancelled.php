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
use App\Carsale;
use App\Carreport;
use App\Carsaleoffer;

class CarSaleOfferCancelled implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $car;
    public $carsale;
    public $carreport;
    public $carsaleoffer;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Car $car, Carsale $carsale, Carreport $carreport, Carsaleoffer $carsaleoffer)
    {
        $this->user = $user;
        $this->car = $car;
        $this->carsale = $carsale;
        $this->carreport = $carreport;
        $this->carsaleoffer = $carsaleoffer;
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
