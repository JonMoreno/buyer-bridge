<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\TimeCapsule;
use Illuminate\Http\Request;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeCapsuleController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticateUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Authentication routes.
Route::post('/login', [AuthenticateUserController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthenticateUserController::class, 'logout'])->middleware('auth');
Route::post('/register', [RegisteredUserController::class, 'register'])->middleware('guest');


// Authenticated routes.
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/capsules', TimeCapsuleController::class);
    Route::get('/user', [AuthenticateUserController::class, 'user']);
});
