<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Carrent;

class CarRentAdded implements ShouldBroadcast 
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $car;
    public $carrent;
    public $carimages;
    public $comment_count;
    public $tail_count;
    public $offer_count;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Carrent $carrent)
    {
        $this->car = $carrent->car;
        $this->carrent = $current;
        $this->carimages = $carrent->car->images;
        $this->comment_count = $carrent->car->comments->count();
        $this->offer_count = $carrent->offers->count();
        $this->tail_count = $carrent->car->tails->count();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('public-channel');
    }
}
