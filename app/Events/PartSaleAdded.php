<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Partsale;

class PartSaleAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $part;
    public $partsale;
    public $partimages;
    public $comment_count;
    public $tail_count;
    public $offer_count;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Partsale $partsale)
    {
        $this->part = $partsale->part;
        $this->partsale = $partsale;
        $this->partimages = $partsale->part->images;
        $this->comment_count = $partsale->part->comments->count();
        $this->offer_count = $partsale->offers->count();
        $this->tail_count = $partsale->part->tails->count();
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
