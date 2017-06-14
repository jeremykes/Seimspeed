<?php

// This notification is sent to the User AFTER it goes through screening and we agree that it violates our rules.

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

use App\Userreport;

class UserReportedNotification extends Notification
{
    use Queueable;

    public $userreport;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Userreport $userreport)
    {
        $this->userreport = $userreport;
        $this->url = url('/user/' . $this->userreport->user->id . '/report/' . $this->userreport->id);
        $this->message = 'You have violated our rules and your account has been disabled.';
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
