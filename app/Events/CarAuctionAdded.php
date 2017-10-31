<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Carauction;

class CarAuctionAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $car;
    public $carauction;
    public $carimages;
    public $comment_count;
    public $tail_count;
    public $offer_count;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Carauction $carauction)
    {
        $this->car = $carauction->car;
        $this->carauction = $carauction;
        $this->carimages = $carauction->car->images;
        $this->comment_count = $carauction->car->comments->count();
        $this->offer_count = $carauction->bids->count();
        $this->tail_count = $carauction->car->tails->count();
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
