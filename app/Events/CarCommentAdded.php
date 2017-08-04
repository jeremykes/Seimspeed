<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Carcomment;

use DB;

class CarCommentAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $carcomment;
    private $carid;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Carcomment $carcomment)
    {
        $this->carid = $carcomment->car->id;
        $this->carcomment = DB::table('carcomments')
                    ->leftJoin('users', 'users.id', '=', 'carcomments.user_id')
                    ->select('carcomments.*', 'users.propic', 'users.name')
                    ->where('carcomments.id', $carcomment->id)
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
