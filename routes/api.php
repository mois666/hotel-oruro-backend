<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// auth
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
//ruta /api-carousel

//ruta para obtener los datos del sistemas como logo, nombre, etc
//Route::get('/system-data', [SettingController::class, 'getSystemData']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/auth/checkToken', [AuthController::class, 'checkAuthToken']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    //Route::apiResource('/settings', SettingController::class)->only(['show', 'update']);

    /**** USUARIOS ****/
    Route::apiResource('/users', UserController::class);
    /*Rooms*/
    Route::apiResource('/rooms', RoomController::class);
    /*clients*/
    Route::apiResource('/clients', ClientController::class);
    /*reservations*/
    Route::apiResource('/reservations', ReservationController::class);
    /*assignments*/
    Route::apiResource('/assignments', AssignmentController::class);
});


// personal access token PARA PROYECTO ACCOUNTS
Route::post('/create-token', [AuthController::class, 'createToken']);
Route::post('/delete-token/{id}', [AuthController::class, 'deleteToken']);


Route::middleware(['auth:sanctum', CheckRole::class . ':Admin-Owner-Worker-User'])->group(function () {
    //Route::apiResource('/carousels', CarouselController::class);
});
