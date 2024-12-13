<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BedManager\RoomController;
use App\Http\Controllers\UserHomeController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Fetch rooms for a selected category
Route::get('/rooms/{categoryId}', [RoomController::class, 'getRoomsByCategory']);

// Fetch room details including block name and beds for a given room number
Route::get('/room/details/{roomNo}', [RoomController::class, 'getRoomDetails']);


Route::get('/api/rooms/{categoryId}', function ($categoryId) {
    $roomNumbers = \App\Models\Room::where('room_category_id', $categoryId)->get(['room_no']);
    return response()->json(['roomNumbers' => $roomNumbers]);
});
Route::get('/api/rooms/{categoryId}', [UserHomeController::class, 'getRoomsByCategory']);


