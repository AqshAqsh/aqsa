<?php

if (!function_exists('getNotificationRoute')) {
    function getNotificationRoute($type)
    {
        switch ($type) {
            case 'NewBookingNotification':
                return route('admin.bookings.list');
            case 'FeedbackNotification':
                return route('admin.feedback.list');
            default:
                return route('admin.notifications');
        }
    }
}
