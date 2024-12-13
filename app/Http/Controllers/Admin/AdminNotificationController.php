<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;


class AdminNotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $notifications = Auth::user() ? Auth::user()->unreadNotifications : collect();

            Log::info('Notifications count: ' . $notifications->count()); // Log the count of notifications

            View::share('notifications', $notifications);

            return $next($request);
        });
    }

    public function index()
    {
        $admin = Auth::user();

        $notifications = $admin->unreadNotifications;

        return view('admin.notifications.inbox', compact('notifications'));
    }
    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back(); // Redirect back to the notifications page
    }
}
