<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Cartender;

class CarTenderAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $car;
    public $cartender;
    public $carimages;
    public $comment_count;
    public $tail_count;
    public $offer_count;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Cartender $cartender)
    {
        $this->car = $cartender->car;
        $this->cartender = $cartender;
        $this->carimages = $cartender->car->images;
        $this->comment_count = $cartender->car->comments->count();
        $this->offer_count = $cartender->offers->count();
        $this->tail_count = $cartender->car->tails->count();
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
