<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Partsaleoffer;

use DB;

class PartSaleOfferAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $partsaleoffer;
    private $partid;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Partsaleoffer $partsaleoffer)
    {
        $this->partid = $partsaleoffer->partsale->part->id;
        $this->partsaleoffer = DB::table('partsaleoffers')
                    ->leftJoin('users', 'users.id', '=', 'partsaleoffers.user_id')
                    ->select('partsaleoffers.*', 'users.propic', 'users.name')
                    ->where('partsaleoffers.id', $partsaleoffer->id)
                    ->get();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('public-channel.part.'.$this->partid);
    }
}
