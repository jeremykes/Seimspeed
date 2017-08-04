<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Carsale;

class CarSaleAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $car;
    public $carsale;
    public $carimages;
    public $comment_count;
    public $tail_count;
    public $offer_count;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Carsale $carsale)
    {
        $this->car = $carsale->car;
        $this->carsale = $carsale;
        $this->carimages = $carsale->car->images;
        $this->comment_count = $carsale->car->comments->count();
        $this->offer_count = $carsale->offers->count();
        $this->tail_count = $carsale->car->tails->count();
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
