<?php

use App\Events\MessageSentEvents;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Models\Room;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

