<?php

use App\Events\Message;
use App\Events\MessageSentEvents;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RoomController;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    dd($request->user());
})->middleware('auth:sanctum');

Route::post("/coba/{room}", function (Room $room) {
    Log::info('Route hit. Dispatching event...');

    // dd($room->id);

    try {
        MessageSentEvents::dispatch($room->makeHidden('id')->toArray(), $room->id);
        Log::info('Event dispatched successfully.');
        return response()->json("a");
    } catch (\Throwable $th) {
        Log::error('Error dispatching event: ' . $th->getMessage());
        return response()->json("asdsad");
    }
});


Route::post("/login", [AuthenticationController::class, "login"]);
Route::post("/register", [AuthenticationController::class, "register"]);
Route::resource('/room', RoomController::class)->except(['create', 'edit'])->middleware('auth:sanctum');
Route::resource('/message', MessageController::class)->middleware('auth:sanctum');
