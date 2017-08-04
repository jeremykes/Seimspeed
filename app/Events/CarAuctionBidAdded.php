<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Carauctionbid;

use DB;

class CarAuctionBidAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $carauctionbid;
    private $carid;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Carauctionbid $carauctionbid)
    {
        $this->carid = $carauctionbid->carauction->car->id;
        $this->carauctionbid = DB::table('carauctionbids')
                    ->leftJoin('users', 'users.id', '=', 'carauctionbids.user_id')
                    ->select('carauctionbids.*', 'users.propic', 'users.name')
                    ->where('carauctionbids.id', $carauctionbid->id)
                    ->get();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('public-channel.car.'.$this->carid);
    }
}
