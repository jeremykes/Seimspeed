<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

use App\Carcomment;

class CarCommentAddedNotification extends Notification
{
    use Queueable;

    public $url;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Carcomment $carcomment)
    {
        $this->carcomment = $carcomment;

        if ($this->carcomment->car->sale->exists()) {
           $this->url = url('/corporate/' . $this->carcomment->car->corporate->id . '/car/' . $this->carcomment->car->id . '/sale/' . $this->carcomment->car->sale->id);
        } else if ($this->carcomment->car->rent->exists()) {
           $this->url = url('/corporate/' . $this->carcomment->car->corporate->id . '/car/' . $this->carcomment->car->id . '/rent/' . $this->carcomment->car->rent->id);
        } else if ($this->carcomment->car->auction->exists()) {
           $this->url = url('/corporate/' . $this->carcomment->car->corporate->id . '/car/' . $this->carcomment->car->id . '/auction/' . $this->carcomment->car->auction->id);
        } else if ($this->carcomment->car->tender->exists()) {
           $this->url = url('/corporate/' . $this->carcomment->car->corporate->id . '/car/' . $this->carcomment->car->id . '/tender/' . $this->carcomment->car->tender->id);
        }

        $this->message = $this->carcomment->user->name . ' added a comment.';
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
