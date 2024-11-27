<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;use App\Models\Room;

class BookingStatusUpdated extends Notification
{
    use Queueable;

    protected $booking;
    protected $status;

    /**
     * Create a new notification instance.
     */
    public function __construct($booking, $status)
    {
        $this->booking = $booking;
        $this->status = $status;
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
            ->subject('Booking Status Update')
            ->greeting('Hello ' . $notifiable->name)
            ->line("Your booking for room ID {$this->booking->room_id} has been {$this->status}.")
            ->action('View Booking', url('/bookings/' . $this->booking->id))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification for database storage.
     */
    public function toDatabase($notifiable)
    {
        $roomNumber = Room::find($this->booking->room_id);

        return [
            'message' => 'Your booking status has been updated',
            'booking_id' => $this->booking->id,
            'room_no' => $roomNumber ? $roomNumber->room_no : 'N/A',
            'status' => $this->status,
        ];
    }
}
