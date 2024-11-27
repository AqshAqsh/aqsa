<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FeedbackNotification extends Notification
{
    use Queueable;

    protected $feedback;

    /**
     * Create a new notification instance.
     */
    public function __construct($feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New User Feedback')
            ->greeting('Hello Admin')
            ->line("A new feedback has been submitted by user: {$this->feedback->user->name}")
            ->line("Feedback: {$this->feedback->message}")
            ->action('View Feedback', url(route('admin.feedback.list', $this->feedback->id)))
            ->line('Please review the feedback and take necessary action.');
    }


    /**
     * Get the array representation of the notification for database storage.
     */
    public function toDatabase($notifiable)
    {
        return [
            'feedback_id' => $this->feedback->id,
            'user_id' => $this->feedback->user_id,
            'status' => $this->feedback->status, // Add status for feedback updates
            'message' => "New feedback from user {$this->feedback->user->name}.",
        ];
    }
}
