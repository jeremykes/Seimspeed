<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

use App\Carauction;
use App\Carauctionbid;
use App\Carauctionbidder;

class CarAuctionBidCancelledNotification extends Notification
{
    use Queueable;

    public $url;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Caruaction $carauction, Carauctionbidder $carauctionbidder)
    {
        $this->carauction->$carauction;
        $this->carauctionbidder->$carauctionbidder;
        $this->url = url('/corporate/' . $this->carauction->corporate->id . '/dashboard/'); ;
        $this->message = $carauctionbidder->user_id . ' cancelled the bid on your auction:' $carauction->carauction_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'url' => $this->url,
            'message' => $this->message,
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'url' => $this->url,
            'message' => $this->message,
        ]);
    }
}
