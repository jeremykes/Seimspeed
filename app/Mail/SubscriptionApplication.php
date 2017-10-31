<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Corporate;
use App\Subscription;

class SubscriptionApplication extends Mailable
{
    use Queueable, SerializesModels;

    public $corporate;
    public $subscription;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Corporate $corporate, Subscription $subscription, User $user)
    {
        $this->corporate = $corporate;
        $this->subscription = $subscription;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.subscriptionapplication');
    }
}
