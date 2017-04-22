<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

use App\User;
use App\Car;
use App\Carrent;
use App\Corporate;

class CarRentUpdatedNotification extends Notification
{
    use Queueable;

    public $url;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Car $car, Carrent $carrent, Corporate $corporate)
    {
        $this->user=$user;
        $this->car=$car;
        $this->carrent=$carrent;
        $this->corporate=$corporate;
        $this->url = url('/corporate/' . $this->carauction->corporate->id . '/dashboard/');
        $this->message = $corporate->name . ' updated the rental details for the car: ' . $this->car->model . ' ' . $this->car->make . '';
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
