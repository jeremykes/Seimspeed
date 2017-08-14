<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

use App\Cartendertender;

class CarTenderTenderReservePurchasedNotification extends Notification
{
    use Queueable;

    public $url;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Cartendertender $cartendertender)
    {
        $this->cartendertender = $cartendertender;
        $this->url = url('/corporate/' . $this->cartendertender->cartender->corporate->id . '/car/' . $this->cartendertender->cartender->car->id . '/cartender/' . $this->cartendertender->cartender->id);
        $this->message = 'Congratualations! You have bought this car!';
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
