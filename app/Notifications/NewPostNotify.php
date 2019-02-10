<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewPostNotify extends Notification implements ShouldQueue
{
    use Queueable;
    public $post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($mypost)
    {
        $this->post = $mypost;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New post are available')
                    ->greeting('Hello, Subscriber')
                    ->line('There is a new post, we hope you will enjoy it.')
                    ->line('Post title :: ' . $this->post->title)
                    ->line('To view the post click here.')
                    ->action('view post', url( url('/') ))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
