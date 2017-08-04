<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Carsaleoffer;

use DB;

class CarSaleOfferAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $carsaleoffer;
    private $carid;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Carsaleoffer $carsaleoffer)
    {
        $this->carid = $carsaleoffer->carsale->car->id;
        $this->carsaleoffer = DB::table('carsaleoffers')
                    ->leftJoin('users', 'users.id', '=', 'carsaleoffers.user_id')
                    ->select('carsaleoffers.*', 'users.propic', 'users.name')
                    ->where('carsaleoffers.id', $carsaleoffer->id)
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
