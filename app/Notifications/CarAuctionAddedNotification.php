<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

// 1. Do this if you see that you need to do it.
use App\Auction;

class CarAuctionAddedNotification extends Notification
{
    use Queueable;

    public $url;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    // 2. Add Classes that you think you need to add, depending on the Notification
    public function __construct(Carauction $carauction)
    {
        // 3. Construct all classes to bind to this class.
        $this->carauction = $carauction;
        // 4. Build the URL. All URL's just go straight to the corporate dashboard.
        $this->url = url('/corporate/' . $this->carauction->corporate->id . '/dashboard/');
        // 5. Build the message.
        $this->message = $corporate->name . ' added an auction.';
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
        // 6. Uncomment this two 
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
        // 7. Uncomment this two
        return new BroadcastMessage([
            'url' => $this->url,
            'message' => $this->message,
        ]);
    }
}
