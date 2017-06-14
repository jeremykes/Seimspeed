<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

use App\Partsaleoffer;

class PartSaleOfferReserveExpiredNotification extends Notification
{
    use Queueable;

    public $url;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Partsaleoffer $partsaleoffer)
    {
        $this->partsaleoffer = $partsaleoffer;
        $this->url = url('/corporate/' . $this->partsaleoffer->partsale->corporate->id . '/part/' . $this->partsaleoffer->partsale->part->id . '/sale/' . $this->partsaleoffer->partsale->id);
        $this->message = 'Your offer reserve period has expired. Please contact the supplier if this is a mistake.';
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
