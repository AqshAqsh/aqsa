<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingStatusUpdated extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }
    public function toArray($notifiable)
    {
        return [
            'booking_id' => $this->booking->id,
            'status' => $this->booking->status,
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Booking Status Updated')
            ->line('Your booking status has been updated.')
            ->action('View Booking', url('/bookings/' . $this->booking->id))
            ->line('Thank you for using our application!');
    }
}
