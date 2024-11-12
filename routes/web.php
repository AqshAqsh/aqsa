<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\BedManager\BedController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserHomeController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FeedbackController;

use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\AdminBookingController;


use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\BedManager\RoomCategoryController;
use App\Http\Controllers\Admin\BedManager\RoomController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\FacilityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome');
Route::prefix('user')->group(function () {
    Route::middleware('guest:web')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login');
        Route::post('/login', [LoginController::class, 'login'])->name('auth.login.submit');
    });
    Route::get('/room', [RoomController::class, 'showRooms'])->name('room');
    Route::get('/facilities', [FacilityController::class, 'facilitiesview'])->name('facilities');
    Route::get('/contactus', [FeedbackController::class, 'contact'])->name('contact');
    Route::get('/aboutus', [AboutController::class, 'about'])->name('about');

    Route::middleware('auth:web')->group(function () {
        Route::get('/home', [UserHomeController::class, 'index'])->name('home');
        Route::post('/logout', [LoginController::class, 'userLogout'])->name('user.logout');
        Route::get('/profile', [UserController::class, 'showProfile'])->name('profile.show');
        Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
        Route::get('/inbox', [UserController::class, 'showbookingrequest'])->name('bookingrequestresponse.show');
        Route::post('/notifications/{notificationId}/read', [UserController::class, 'markAsRead'])->name('notifications.read');
        Route::get('/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
        Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
        Route::get('/room/{id}', [RoomController::class, 'showRoomDetails'])->name('room.details');
        Route::get('/room/{room_no}/booking', [BookingController::class, 'bookRoom'])->name('room.booking');
        Route::post('/room/{room_no}/booking', [BookingController::class, 'store'])->name('room.booking.store');
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
        // User Management
        Route::controller(UserController::class)->group(function () {
            Route::get('/user/list', 'index')->name('admin.user.list');
            Route::get('/user/create', 'create')->name('admin.user.create');
            Route::post('/user/store', 'store')->name('admin.user.store');
            Route::get('/user/edit/{id}', 'edit')->name('admin.user.edit');
            Route::delete('/user/delete/{id}', 'delete')->name('admin.user.delete');
            Route::put('/user/update/{id}', 'update')->name('admin.user.update');
        });

        // Notice Management
        Route::controller(NoticeController::class)->group(function () {
            Route::get('/notice/list', 'index')->name('admin.notice.list');
            Route::get('/notice/create', 'create')->name('admin.notice.create');
            Route::post('/notice/store', 'store')->name('admin.notice.store');
            Route::get('/notice/edit/{id}', 'edit')->name('admin.notice.edit');
            Route::delete('/notice/delete/{id}', 'delete')->name('admin.notice.delete');
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
            Route::delete('/bed/delete/{id}', 'delete')->name('admin.bed.delete');
            Route::put('/bed/update/{id}', 'update')->name('admin.bed.update');
        });

        // Member Management
        Route::controller(MemberController::class)->group(function () {
            Route::get('/member/list', 'index')->name('admin.member.list');
            Route::get('/member/create', 'create')->name('admin.member.create');
            Route::post('/member/store', 'store')->name('admin.member.store');
            Route::get('/member/edit/{id}', 'edit')->name('admin.member.edit');
            Route::delete('/member/delete/{id}', 'delete')->name('admin.member.delete');
            Route::put('/member/update/{id}', 'update')->name('admin.member.update');
        });

        // Facility Management
        Route::controller(FacilityController::class)->group(function () {
            Route::get('/facility/list', 'index')->name('admin.facility.list');
            Route::get('/facility/create', 'create')->name('admin.facility.create');
            Route::post('/facility/store', 'store')->name('admin.facility.store');
            Route::get('/facility/edit/{id}', 'edit')->name('admin.facility.edit');
            Route::delete('/facility/delete/{id}', 'delete')->name('admin.facility.delete');
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
