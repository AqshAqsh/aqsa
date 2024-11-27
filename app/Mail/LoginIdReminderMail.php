<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginIdReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user; // Change this to User

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user; // Assign the User object
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Login User_ID')
                    ->view('emails.user_id_reminder') // Reference the correct email view
                    ->with([
                        'user_id' => $this->user->user_id, // Fetch login_id from User
                        'name' => $this->user->name,
                    ]);
    }
}