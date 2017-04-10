<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

use App\Carreport;

class CarReportedNotification extends Notification
{
    use Queueable;

    public $carreport;
    public $url;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Carreport $carreport)
    {
        $this->carreport = $carreport;
        $this->url = url('/corporate/' . $this->carreport->car->corporate->id . '/dashboard/allcars');
        $this->message = "<strong>" . $this->carreport->user->name . "</strong> reported that: <strong>" . $this->carreport->car->make . " " . $this->carreport->car->make. "</strong> " . $this->carreport->report;
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
            'carreport' => $carreport,
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
            'carreport' => $carreport,
            'url' => $this->url,
            'message' => $this->message,
        ]);
    }
}
