<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Cartendertenderer;

use DB;

class CarTenderTendererRequest implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $cartendertenderer;
    private $carid;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Cartendertenderer $cartendertenderer)
    {
        $this->carid = $cartendertenderer->cartender->car->id;
        $this->cartendertenderer = DB::table('cartendertenderers')
                    ->leftJoin('users', 'users.id', '=', 'cartendertenderers.user_id')
                    ->select('cartendertenderers.id', 'cartendertenderers.created_at', 'users.propic', 'users.name')
                    ->where('cartendertenderers.id', $cartendertenderer->id)
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
