<?php

use App\Http\Controllers\Admin\BedManager\BedController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\BedManager\RoomCategoryController;
use App\Http\Controllers\Admin\BedManager\RoomController;
use App\Http\Controllers\Admin\MemberController;

/*
|--------------------------------------------------------------------------|
| Web Routes                                                               |
|--------------------------------------------------------------------------|
| Here is where you can register web routes for your application. These   |
| routes are loaded by the RouteServiceProvider within a group which      |
| contains the "web" middleware group. Now create something great!        |
|--------------------------------------------------------------------------|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/room-1', function () {
    return view('room-1');
});

Route::get('/users/view', [UserController::class, 'view'])->name('users.view');

Auth::routes(); // This includes login, logout, and registration routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home1');

Route::post('/user/logout', [App\Http\Controllers\Auth\LoginController::class, 'userLogout'])->name('user.logout');

// Admin routes
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::view('/login', 'admin.login')->name('admin.login');
        Route::post('/login', [AdminController::class, 'authenticate'])->name('admin.auth');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        // User management routes

    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/user/list', 'index')->name('admin.user.list');
        Route::get('/user/create', 'create')->name('admin.user.create');
        Route::post('/user/store', 'store')->name('admin.user.store');
        Route::get('/user/edit/{id}', 'edit')->name('admin.user.edit');
        Route::get('/user/delete/{id}', 'delete')->name('admin.user.delete');
        Route::put('/user/update/{id}', 'update')->name('admin.user.update');
    });
    Route::controller(NoticeController::class)->group(function () {
        Route::get('/notice/list', 'index')->name('admin.notice.list');
        Route::get('/notice/create', 'create')->name('admin.notice.create');
        Route::post('/notice/store', 'store')->name('admin.notice.store');
        Route::get('/notice/edit/{id}', 'edit')->name('admin.notice.edit');
        Route::get('/notice/delete/{id}', 'delete')->name('admin.notice.delete');
        Route::post('/notice/update/{id}', 'update')->name('admin.notice.update');
    });
    Route::controller(RoomcategoryController::class)->group(function () {
        Route::get('/room/category/list', 'index')->name('admin.room_category.list');
        Route::get('/room/category/create', 'create')->name('admin.room_category.create');
        Route::post('/room/category/store', 'store')->name('admin.room_category.store');
        Route::get('/room/category/edit/{id}', 'edit')->name('admin.room_category.edit');
        Route::get('/room/category/delete/{id}', 'delete')->name('admin.room_category.delete');
        Route::post('/room/category/update/{id}', 'update')->name('admin.room_category.update');
    });

    Route::controller(RoomController::class)->group(function () {
        Route::get('/room/list', 'index')->name('admin.room.list');
        Route::get('/room/create', 'create')->name('admin.room.create');
        Route::post('/room/store', 'store')->name('admin.room.store');
        Route::get('/room/edit/{id}', 'edit')->name('admin.room.edit');
        Route::get('/room/delete/{id}', 'delete')->name('admin.room.delete');
        Route::post('/room/update/{id}', 'update')->name('admin.room.update');
    });
    Route::controller(BedController::class)->group(function () {
        Route::get('/bed/list', 'index')->name('admin.bed.list');
        Route::get('/bed/create', 'create')->name('admin.bed.create');
        Route::post('/bed/store', 'store')->name('admin.bed.store');
        Route::get('/bed/edit/{id}', 'edit')->name('admin.bed.edit');
        Route::get('/bed/delete/{id}', 'delete')->name('admin.bed.delete');
        Route::post('/bed/update/{id}', 'update')->name('admin.bed.update');
    });
    Route::controller(MemberController::class)->group(function () {
        Route::get('/member/list', 'index')->name('admin.member.list');
        Route::get('/member/create', 'create')->name('admin.member.create');
        Route::post('/member/store', 'store')->name('admin.member.store');
        Route::get('/member/edit/{id}', 'edit')->name('admin.member.edit');
        Route::get('/member/delete/{id}', 'delete')->name('admin.member.delete');
        Route::post('/member/update/{id}', 'update')->name('admin.member.update');
    });
});

Route::group(['middleware' => 'auth'], function () {
    // Only users can access these routes
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/rooms', [App\Http\Controllers\HomeController::class, 'room'])->name('room');
    Route::get('/facilities', [App\Http\Controllers\HomeController::class, 'facilities'])->name('facilities');
    Route::get('/contactus', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
    Route::get('/aboutus', [App\Http\Controllers\HomeController::class, 'about'])->name('about');


});
