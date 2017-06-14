<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

use App\Cartail;

class CarTailedNotification extends Notification
{
    use Queueable;

    public $url;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Cartail $cartail)
    {
        $this->cartail = $cartail;

        if ($this->cartail->car->sale->exists()) {
           $this->url = url('/corporate/' . $this->cartail->car->corporate->id . '/car/' . $this->cartail->car->id . '/sale/' . $this->cartail->car->sale->id);
        } else if ($this->cartail->car->rent->exists()) {
           $this->url = url('/corporate/' . $this->cartail->car->corporate->id . '/car/' . $this->cartail->car->id . '/rent/' . $this->cartail->car->rent->id);
        } else if ($this->cartail->car->auction->exists()) {
           $this->url = url('/corporate/' . $this->cartail->car->corporate->id . '/car/' . $this->cartail->car->id . '/auction/' . $this->cartail->car->auction->id);
        } else if ($this->cartail->car->tender->exists()) {
           $this->url = url('/corporate/' . $this->cartail->car->corporate->id . '/car/' . $this->cartail->car->id . '/tender/' . $this->cartail->car->tender->id);
        }

        $this->message = $this->cartail->user->name . ' is tailing your car.';
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
