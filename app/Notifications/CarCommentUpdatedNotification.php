<?php

// This is not necessary. Simply becuase this is overkill.

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

use App\Car;
use App\User;
use App\Carcomment;

class CarCommentUpdatedNotification extends Notification
{
    use Queueable;

    public $url;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Car $car, Carcomment $carcomment, User $user)
    {
        $this->car=$car;
        $this->user=$user;
        $thos->carcomment=$carcomment;
        $this->url = url('/corporate/' . $this->carauction->corporate->id . '/dashboard/');
        $this->message = 'Comment updated. ' . $carcomment->comment;
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
