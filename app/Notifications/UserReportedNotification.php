<?php

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
        $this->userrreport = $userreport;
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
            'report' => $this->userreport->userreport,
            'reporting_user_name' => $this->userreport->reporting_user->name,
            'reporting_user_id' => $this->userreport->reporing_user->id,
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
            'report' => $this->userreport->userreport,
            'reporting_user_name' => $this->userreport->reporting_user->name,
            'reporting_user_id' => $this->userreport->reporing_user->id,
        ]);
    }
}
