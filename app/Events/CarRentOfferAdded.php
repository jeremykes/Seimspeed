<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Carrentoffer;

use DB;

class CarRentOfferAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $carrentoffer;
    private $carid;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Carrentoffer $carrentoffer)
    {
        $this->carid = $carrentoffer->carrent->car->id;
        $this->carrentoffer = DB::table('carrentoffers')
                    ->leftJoin('users', 'users.id', '=', 'carrentoffers.user_id')
                    ->select('carrentoffers.*', 'users.propic', 'users.name')
                    ->where('carrentoffers.id', $carrentoffer->id)
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
