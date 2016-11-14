<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Mail;

class VerifyEmail extends Notification
{
    use Queueable;

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public static function toMail($user)
    {
        
        //Create register email
        Mail::queue('auth.emails.verify', ['user' => $user], function ($message) use ($user) {
            $message->to($user['email'], $user['first_name'])
               ->subject('Verify your email address');
        });

    }

}
