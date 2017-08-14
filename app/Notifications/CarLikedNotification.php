<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

use App\Carlike;

class CarLikedNotification extends Notification
{
    use Queueable;

    public $url;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Carlike $carlike)
    {
        $this->carlike = $carlike;

        if ($this->carlike->car->sale->exists()) {
           $this->url = url('/corporate/' . $this->carlike->car->corporate->id . '/car/' . $this->carlike->car->id . '/carsale/' . $this->carlike->car->sale->id);
        } else if ($this->carlike->car->rent->exists()) {
           $this->url = url('/corporate/' . $this->carlike->car->corporate->id . '/car/' . $this->carlike->car->id . '/carrent/' . $this->carlike->car->rent->id);
        } else if ($this->carlike->car->auction->exists()) {
           $this->url = url('/corporate/' . $this->carlike->car->corporate->id . '/car/' . $this->carlike->car->id . '/carauction/' . $this->carlike->car->auction->id);
        } else if ($this->carlike->car->tender->exists()) {
           $this->url = url('/corporate/' . $this->carlike->car->corporate->id . '/car/' . $this->carlike->car->id . '/cartender/' . $this->carlike->car->tender->id);
        }

        $this->message = $this->carlike->user->name . ' liked your car.';
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
