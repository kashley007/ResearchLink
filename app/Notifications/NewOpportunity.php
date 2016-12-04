<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Notification_Model;
use Mail;

class NewOpportunity extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public static function toDatabase($user, $notificationData)
    {
        $notification = new Notification_Model;
        $notification->user_id = $user->id;
        $notification->type_of_notification = 'newOpportunity';
        $notification->title_html = 'New Opportunity!';
        $notification->body_html = 'A new opportunity, ' . $notificationData['title'] . ', related to your interests has been created!'; //Need link to application
        $notification->is_read = 0;
        $notification->save();
    }
    public static function toMail($user, $notificationData)
    {
        
        //Create register email
        Mail::queue('auth.emails.matchedOpportunity', ['user' => $user], function ($message) use ($user) {
            $message->to($user['email'], $user['first_name'])
               ->subject('A new Research Opportunity has been created!');
        });

    }

}
