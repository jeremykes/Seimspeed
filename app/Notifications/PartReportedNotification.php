<?php

// This notification is sent to the Corporate AFTER it goes through screening and we agree that it violates our rules.

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

use App\Partreport;

class PartReportedNotification extends Notification
{
    use Queueable;

    public $partreport;
    public $url;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Partreport $partreport)
    {
        $this->partreport = $partreport;
        $this->url = url('/corporate/' . $this->partreport->corporate->id . '/part/' . $this->partreport->part->id . '/report/' . $this->partreport->id);
        $this->message = 'Your part violated our rules and has been deleted.';
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
