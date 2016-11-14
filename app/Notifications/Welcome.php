<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Notification_Model;

class Welcome extends Notification
{
    use Queueable;

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public static function toDatabase($user)
    {
        $notification = new Notification_Model;
        $notification->user_id = $user->id;
        $notification->type_of_notification = 'welcome';
        $notification->title_html = 'Welcome';
        $notification->body_html = 'Welcome to ResearchLink! Remember to complete your profile to get linked to new research opportunities. Thank you for signing up and good luck!';
        $notification->is_read = 0;
        $notification->save();
    }

}
