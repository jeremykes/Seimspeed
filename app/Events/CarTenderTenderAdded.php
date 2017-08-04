<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Cartendertender;

use DB;

class CarTenderTenderAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $cartendertender;
    private $carid;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Cartendertender $cartendertender)
    {
        $this->carid = $cartendertender->cartender->car->id;
        $this->cartendertender = DB::table('cartendertenders')
                    ->leftJoin('users', 'users.id', '=', 'cartendertenders.user_id')
                    ->select('cartendertenders.*', 'users.propic', 'users.name')
                    ->where('cartendertenders.id', $cartendertender->id)
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
