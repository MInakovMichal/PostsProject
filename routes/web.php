<?php

use Component\Post\Infrastructure\Http\Controllers\PostController;
use Component\User\Infrastructure\Http\Controllers\NotificationController;
use Component\User\Infrastructure\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'web', 'verified'])->group(function () {
    Route::post('/setLocale/{locale}', [UserController::class, 'setLocale'])->name('set.locale');

    Route::get('/', [PostController::class, 'getAllPosts'])->name('dashboard');

    Route::controller(PostController::class)->name('post')->group(function () {
        Route::get('post', 'showAddPostForm');
        Route::post('post', 'addPost')->name('.add');
        Route::delete('/post', 'deletePost')->name('.delete');
    });

    Route::controller(NotificationController::class)->name('notification')->group(function () {
        Route::get('notification', 'showAddNotificationForm');
        Route::post('notification', 'sendNotification')->name('.send');
    });
});

require __DIR__ . '/auth.php';
