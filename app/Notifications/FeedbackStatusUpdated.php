<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;


class FeedbackStatusUpdated extends Notification
{
    use Queueable;
    protected $feedback;
    protected $status;


    public function __construct($feedback, $status)
    {
        $this->feedback = $feedback;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
            ->subject('Feedback Status Update')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your feedback has been updated.')
            ->line('Feedback Message: ' . $this->feedback->message)
            ->line('New Status: ' . $this->status)
            ->action('View Feedback', url('/feedbacks/' . $this->feedback->id))
            ->line('Thank you for providing your valuable feedback!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        Log::debug('Feedback Notification Data:', [
            'feedback_id' => $this->feedback->id,
            'feedback_message' => $this->feedback->message,
            'status' => $this->status,
        ]);

        return [
            'message' => 'Your feedback status has been updated.',
            'feedback_id' => $this->feedback->id,
            'feedback_message' => $this->feedback->message,
            'status' => $this->status,
        ];
    }
}
