<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LikeOrCommentNotification extends Notification
{
    use Queueable;

    protected $message;
    protected $post_id;

    /**
     * Create a new notification instance.
     */
    public function __construct($message, $post_id)
    {
        $this->message = $message;
        $this->post_id = $post_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Like or Comment')
            ->greeting("Hello $notifiable->name !")
            ->line($this->message)
            ->action('View Post', url('posts/' . $this->post_id))
            ->line('Thank you for using Artems blog!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
