<?php

use App\Http\Controllers\api\v1\auth\LoginController;
use App\Http\Controllers\api\v1\auth\LogoutController;
use App\Http\Controllers\api\v1\place\PlaceController;
use App\Http\Controllers\api\v1\route\RouteController;
use App\Http\Controllers\api\v1\schedule\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth.middleware')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::withoutMiddleware('auth.middleware')->group(function () {
                Route::post('/login', [LoginController::class, 'login']);
            });

            Route::get('/logout', [LogoutController::class, 'logout']);
        });

        Route::prefix('place')->group(function () {
            Route::get('/', [PlaceController::class, 'getAllPlaces']);
            Route::get('/{id}', [PlaceController::class, 'getPlaceById']);
            Route::post('/', [PlaceController::class, 'createPlace']);
            Route::put('/{id}', [PlaceController::class, 'updatePlace']);
            Route::delete('/{id}', [PlaceController::class, 'deletePlace']);
         });

        Route::middleware('admin.middleware')->group(function () {
            Route::prefix('schedule')->group(function () {
                Route::get('/', [ScheduleController::class, 'getAllSchedules']);
                Route::post('/', [ScheduleController::class, 'createSchedule']);
                Route::put('/{id}', [ScheduleController::class, 'updateSchedule']);
                Route::delete('/{id}', [ScheduleController::class, 'deleteSchedule']);
            });
        });

        Route::prefix('route')->group(function () {
           Route::get('/search/{from_place_id}/{to_place_id}/{departure_time?}', [RouteController::class, 'getRoute']);
        });
    });
});
