<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\BedManager\BedController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\UserNotificationController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\BedManager\RoomCategoryController;
use App\Http\Controllers\Admin\BedManager\RoomController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\FacilityController;
use Illuminate\Support\Facades\Mail;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Route::get('/api/rooms/{categoryId}', function ($categoryId) {
    $roomNumbers = \App\Models\Room::where('room_category_id', $categoryId)->get(['room_no']);
    return response()->json(['roomNumbers' => $roomNumbers]);
});


Route::get('/forgot-user-id', [LoginController::class, 'showForgotIdForm'])->name('forgot.user.id');
Route::post('/forgot-user-id', [LoginController::class, 'processForgotId'])->name('forgot.user.id.submit');
Route::get('/forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('forgot.password');
Route::post('/forgot-password', [LoginController::class, 'processForgotPassword'])->name('forgot.password.submit');
Route::prefix('user')->group(function () {
    Route::middleware('guest:web')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login');
        Route::post('/login', [LoginController::class, 'login'])->name('auth.login.submit');
    });
    Route::get('/home', [UserHomeController::class, 'index'])->name('home');
    Route::get('/room', [RoomController::class, 'showRooms'])->name('room');
    Route::get('/facilities', [FacilityController::class, 'facilitiesview'])->name('facilities');
    Route::get('/contactus', [FeedbackController::class, 'contact'])->name('contact');
    Route::get('/aboutus', [AboutController::class, 'about'])->name('about');




    Route::middleware('auth:web')->group(function () {
        Route::post('/logout', [LoginController::class, 'userLogout'])->name('user.logout');
        Route::get('/profile', [UserController::class, 'showProfile'])->name('profile.show');
        Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
        Route::get('rooms/filter', [RoomController::class, 'filterRooms'])->name('rooms.filter');
        Route::get('/notifications', [UserNotificationController::class, 'index'])->name('user.notifications');
        Route::post('/notifications/read/{id}', [UserNotificationController::class, 'markAsRead'])->name('notification.read');
        Route::get('/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
        Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
        Route::get('/room/{id}', [RoomController::class, 'showRoomDetails'])->name('room.details');
        Route::get('booking/{booking_id}', [BookingController::class, 'show'])->name('room.showbooking');
        Route::get('/room/{room_no}/booking', [BookingController::class, 'bookRoom'])->name('room.booking');
        Route::post('/room/{room_no}/booking', [BookingController::class, 'store'])->name('room.booking.store');
        Route::get('/room/booking/{id}/downloadReport', [BookingController::class, 'downloadReport'])->name('room.report');
        Route::delete('/booking/{id}/delete', [BookingController::class, 'deleteBooking'])->name('booking.delete');
        Route::get('/notice', [UserController::class, 'showNotice'])->name('notice');
        Route::post('/notice/{noticeId}/mark-as-read', [UserController::class, 'markAsRead'])->name('notices.markAsRead');
        Route::get('/check-availability', [UserHomeController::class, 'checkAvailability'])->name('check.availability');
        Route::get('/filterRooms', [RoomController::class, 'filterRooms'])->name('rooms.filter');
        //Route::get('/rooms/search', [RoomController::class, 'search'])->name('room.search');
        //Route::get('/get-room-details/{room_no}', [RoomController::class, 'getRoomDetails']);
    });
});

Auth::routes();

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::middleware('admin.guest')->group(function () {
        Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminController::class, 'authenticate'])->name('admin.login.submit');
    });
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminController::class, 'adminlogout'])->name('admin.logout');
        Route::get('/feedback', [FeedbackController::class, 'index'])->name('admin.feedback.list');
        Route::post('/feedback/{feedback}/status', [AdminController::class, 'updateFeedbackStatus'])->name('admin.feedback.updateStatus');
        Route::get('/admin/profile', [AdminController::class, 'showProfile'])->name('admin.profile');
        Route::put('/admin/profile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
        Route::get('beds', [AdminBookingController::class, 'showbedassign'])->name('admin.bed.show');
        Route::get('admin/beds/{bed}/assign', [BedController::class, 'assign'])->name('admin.bed.assigned');
        Route::post('/admin/notice/send', [NoticeController::class, 'sendNotice'])->name('admin.notice.send');
        Route::get('/documentation', [AdminController::class, 'view'])->name('admin.documentation');

        //Route::get('/admin/dashboard', [AdminNotificationController::class, 'getNotifications'])->name('admin.dashboard');
        Route::get('/admin/notifications', [AdminNotificationController::class, 'index'])->name('admin.notifications');
        Route::patch('/admin/notifications/{notification}', [AdminNotificationController::class, 'markAsRead'])->name('admin.notifications.markAsRead');



        Route::get('/live-stream', function () {
            return view('admin.stream');
        })->name('live-stream');

        // User Management
        Route::controller(UserController::class)->group(function () {
            Route::get('/user/list', 'index')->name('admin.user.list');
            Route::get('/user/create', 'create')->name('admin.user.create');
            Route::post('/user/store', 'store')->name('admin.user.store');
            Route::get('/users/edit/{user_id}', [UserController::class, 'edit'])->name('admin.user.edit');
            Route::put('/users/update/{user_id}', [UserController::class, 'update'])->name('admin.user.update');
            Route::delete('/users/delete/{user_id}', [UserController::class, 'delete'])->name('admin.user.delete');
        });

        // Notice Management
        Route::controller(NoticeController::class)->group(function () {
            Route::get('/notice/list', 'index')->name('admin.notice.list');
            Route::get('/notice/create', 'create')->name('admin.notice.create');
            Route::post('/notice/store', 'store')->name('admin.notice.store');
            Route::get('/notice/edit/{id}', 'edit')->name('admin.notice.edit');
            Route::get('/notice/delete/{id}', 'delete')->name('admin.notice.delete');
            Route::put('/notice/update/{id}', 'update')->name('admin.notice.update');
        });

        // Room Category Management
        Route::controller(RoomCategoryController::class)->group(function () {
            Route::get('/room/category/list', 'index')->name('admin.room_category.list');
            Route::get('/room/category/create', 'create')->name('admin.room_category.create');
            Route::post('/room/category/store', 'store')->name('admin.room_category.store');
            Route::get('/room/category/edit/{id}', 'edit')->name('admin.room_category.edit');
            Route::delete('/room/category/delete/{id}', 'delete')->name('admin.room_category.delete');
            Route::put('/room/category/update/{id}', 'update')->name('admin.room_category.update');
        });

        // Room Management
        Route::controller(RoomController::class)->group(function () {
            Route::get('/room/list', 'index')->name('admin.room.list');
            Route::get('/room/create', 'create')->name('admin.room.create');
            Route::post('/room/store', 'store')->name('admin.room.store');
            Route::get('/room/edit/{id}', 'edit')->name('admin.room.edit');
            Route::delete('/room/delete/{id}', 'delete')->name('admin.room.delete');
            Route::put('/room/update/{id}', 'update')->name('admin.room.update');
        });

        // Bed Management
        Route::controller(BedController::class)->group(function () {
            Route::get('/bed/list', 'index')->name('admin.bed.list');
            Route::get('/bed/create', 'create')->name('admin.bed.create');
            Route::post('/bed/store', 'store')->name('admin.bed.store');
            Route::get('/bed/edit/{id}', 'edit')->name('admin.bed.edit');
            Route::get('/bed/delete/{id}', 'delete')->name('admin.bed.delete');
            Route::put('/bed/update/{id}', 'update')->name('admin.bed.update');
        });

        // Facility Management
        Route::controller(FacilityController::class)->group(function () {
            Route::get('/facility/list', 'index')->name('admin.facility.list');
            Route::get('/facility/create', 'create')->name('admin.facility.create');
            Route::post('/facility/store', 'store')->name('admin.facility.store');
            Route::get('/facility/edit/{id}', 'edit')->name('admin.facility.edit');
            Route::get('/facility/delete/{id}', 'delete')->name('admin.facility.delete');
            Route::put('/facility/update/{id}', 'update')->name('admin.facility.update');
        });

        // Booking Management
        Route::controller(AdminBookingController::class)->group(function () {
            Route::get('/admin/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.list');
            Route::post('/admin/bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('admin.bookings.approve');
            Route::post('/admin/bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('admin.bookings.reject');
        });
    });
});
