<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

use App\Corporatetail;

class CorporaorporateTailedNotification extends Notification
{
    use Queueable;

    public $url;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Corporatetail $corporatetail)
    {
        $this->corporatetail = $corporatetail;

        if ($this->corporatetail->car->sale->exists()) {
           $this->url = url('/corporate/' . $this->corporatetail->car->corporate->id . '/car/' . $this->corporatetail->car->id . '/sale/' . $this->corporatetail->car->sale->id);
        } else if ($this->corporatetail->car->rent->exists()) {
           $this->url = url('/corporate/' . $this->corporatetail->car->corporate->id . '/car/' . $this->corporatetail->car->id . '/rent/' . $this->corporatetail->car->rent->id);
        } else if ($this->corporatetail->car->auction->exists()) {
           $this->url = url('/corporate/' . $this->corporatetail->car->corporate->id . '/car/' . $this->corporatetail->car->id . '/auction/' . $this->corporatetail->car->auction->id);
        } else if ($this->corporatetail->car->tender->exists()) {
           $this->url = url('/corporate/' . $this->corporatetail->car->corporate->id . '/car/' . $this->corporatetail->car->id . '/tender/' . $this->corporatetail->car->tender->id);
        }

        $this->message = $this->corporatetail->user->name . ' is tailing you.';
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
