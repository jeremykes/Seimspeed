<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Partcomment;

use DB;

class PartCommentAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $partcomment;
    private $partid;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Partcomment $partcomment)
    {
        $this->partid = $partcomment->part->id;
        $this->partcomment = DB::table('partcomments')
                    ->leftJoin('users', 'users.id', '=', 'partcomments.user_id')
                    ->select('partcomments.*', 'users.propic', 'users.name')
                    ->where('partcomments.id', $partcomment->id)
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
