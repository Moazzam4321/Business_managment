<?php

namespace App\Listeners;

use App\Events\MailSent;
use App\Models\User;
use App\Notifications\SendingMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPodcastNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MailSent $event): void
    {
       // Get the user with the given email
       $user = User::where('email', $event->email)->first();
        
      //  Send the notification to the user
       $user->notify(new SendingMail());
    }
}
