<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class AdminNotificationController extends Controller
{
    public function __construct()
    {
        // Ensure notifications are available globally in all views
        $this->middleware(function ($request, $next) {
            // Fetch unread notifications for the logged-in admin
            $notifications = Auth::user() ? Auth::user()->unreadNotifications : collect();

            // Share the notifications with all views
            View::share('notifications', $notifications);

            return $next($request);
        });
    }

    public function index()
    {
        // Get the authenticated admin user
        $admin = Auth::user();

        // Retrieve all unread notifications for the admin
        $notifications = $admin->unreadNotifications;

        return view('admin.notifications.inbox', compact('notifications'));
    }
    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back(); // Redirect back to the notifications page
    }
}
