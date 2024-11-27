<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Notifications\Notification;

use Illuminate\Http\Request;

class UserNotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;
        return view('notifications', compact('notifications'));
    }

    public function markAsRead($id)
    {
        // Attempt to find the notification
        $notification = auth()->user()->notifications()->find($id);

        if (!$notification) {
            // Redirect with error if notification is not found
            return redirect()->route('user.notifications')->with('error', 'Notification not found');
        }

        // Mark the notification as read
        $notification->markAsRead();

        // Redirect with success message
        return redirect()->route('user.notifications')->with('success', 'Notification marked as read');
    }
}
