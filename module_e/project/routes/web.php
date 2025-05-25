<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Poll\PollController;
use App\Http\Controllers\ShortLink\ShortLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::withoutMiddleware('admin')->middleware('guest')->group(function () {
        Route::get('/login', [AdminController::class, 'showLogin']);
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
    });

    Route::get('/', [AdminController::class, 'showAdmin']);
    Route::get('/logout', [AdminController::class, 'logout']);

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'showCategories']);
        Route::post('/', [CategoryController::class, 'createCategory'])->name('category.create');
        Route::post('/{id}', [CategoryController::class, 'updateCategory'])->name('category.update');
    });

    Route::prefix('polls')->group(function () {
        Route::get('/', [PollController::class, 'showPolls']);
        Route::get('/{id}', [PollController::class, 'showPollById']);
        Route::delete('/{id}', [PollController::class, 'deletePoll'])->name('poll.delete');
    });

    Route::prefix('links')->group(function () {
        Route::post('/{id}/create', [ShortLinkController::class, 'createLink'])->name('link.create');
        Route::delete('/{id}/delete', [ShortLinkController::class, 'deleteLink'])->name('link.delete');
    });
});

Route::get('/{short_link}', [PollController::class, 'showPublicPollByShortLink']);
Route::post('/send', [PollController::class, 'sendPublicPoll'])->name('poll.send');
