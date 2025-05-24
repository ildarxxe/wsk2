<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Poll\PollController;
use App\Http\Controllers\ShortLink\ShortLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/{short_link}/send-poll', [PollController::class, 'sendPoll'])->name('send.poll');

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::withoutMiddleware('admin')->group(function () {
        Route::get('/login', function () {
            return view('admin.login');
        });
        Route::post('login', [AdminController::class, 'login'])->name('admin.login');
    });
    Route::get('/', function () {
        return view('admin.admin');
    });
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'showCategories']);
        Route::post('/{id}', [CategoryController::class, 'updateCategory'])->name('update.category');
        Route::post('/', [CategoryController::class, 'createCategory'])->name('create.category');
    });

    Route::prefix('polls')->group(function () {
        Route::get('/', [PollController::class, 'showPolls']);
        Route::get('/{id}', [PollController::class, 'showPollById']);
    });

    Route::prefix('short-links')->group(function () {
        Route::post('/{id}', [ShortLinkController::class, 'createShortLink'])->name('create.link');
    });
});

Route::get('/{short_link}', [PollController::class, 'showPollByShortLink']);
