<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;


class NewBookingNotification extends Notification
{
    use Queueable;

    protected $booking;

    /**
     * Create a new notification instance.
     */
    public function __construct($booking)
    {
        $this->booking = $booking;
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
            ->line('You have a new booking request.')
            ->action('View Booking', route('admin.bookings.list', ['booking' => $this->booking->id]))
            ->line('Please review the booking and approve or reject it.');
            
    }

    /**
     * Get the array representation of the notification for database storage.
     */
    public function toDatabase($notifiable)
    {
        $roomNumber = $this->booking->room ? $this->booking->room->room_no : 'Unknown Room';
        return [
            'booking_id' => $this->booking->id,
            'room_id' => $this->booking->room_id,
            'status' => $this->booking->status,
            'message' => "New booking request from " . ($this->booking->user->name ?? 'Unknown User') . " for room " . $roomNumber . " (Status: " . $this->booking->status . ")",
        ];
    }
}
