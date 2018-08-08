<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Carauctionbidder;

use DB;

class CarAuctionBidderRequest implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $carauctionbidder;
    private $carid;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Carauctionbidder $carauctionbidder)
    {
        $this->carid = $carauctionbidder->carauction->car->id;
        $this->carauctionbidder = DB::table('carauctionbidders')
                    ->leftJoin('users', 'users.id', '=', 'carauctionbidders.user_id')
                    ->select('carauctionbidders.id as carauctionbidders_id', 'carauctionbidders.created_at', 'users.id as user_id', 'users.propic', 'users.name')
                    ->where('carauctionbidders.id', $carauctionbidder->id)
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
