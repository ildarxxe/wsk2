<?php

use App\Http\Controllers\api\v1\auth\AuthController;
use App\Http\Controllers\api\v1\place\PlaceController;
use App\Http\Controllers\api\v1\route\RouteController;
use App\Http\Controllers\api\v1\schedule\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::withoutMiddleware('auth')->group(function () {
                Route::post('/login', [AuthController::class, 'login']);
            });
            Route::get('/logout', [AuthController::class, 'logout']);
        });

        Route::prefix('place')->group(function () {
            Route::get('/', [PlaceController::class, 'getAllPlaces']);
            Route::get('/{id}', [PlaceController::class, 'getPlaceById']);

            Route::middleware('admin')->group(function () {
                Route::post('/', [PlaceController::class, 'createPlace']);
                Route::post('/{id}', [PlaceController::class, 'updatePlace']);
                Route::delete('/{id}', [PlaceController::class, 'deletePlace']);
            });
        });

        Route::prefix('schedule')->middleware('admin')->group(function () {
            Route::get('/', [ScheduleController::class, 'getAllSchedules']);
            Route::post('/', [ScheduleController::class, 'createSchedule']);
            Route::post('/{id}', [ScheduleController::class, 'updateSchedule']);
            Route::delete('/{id}', [ScheduleController::class, 'deleteSchedule']);
        });

        Route::prefix('route')->group(function () {
            Route::get('/search/{from_place_id}/{to_place_id}/{departure_time?}', [RouteController::class, 'searchRoutes']);
            Route::post('/selection', [RouteController::class, 'saveRouteSelection']);
        });
    });
});
