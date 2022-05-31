<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['is_admin', 'auth:sanctum,admin', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('clear', function () {
        \Artisan::call('optimize:clear');
        \Artisan::call('optimize');
        \Artisan::call('config:clear');
        \Artisan::call('config:cache');
        \Artisan::call('view:clear');
        \Artisan::call('view:cache');
        \Artisan::call('route:clear');
        \Artisan::call('route:cache');
        dd("Optimized. Cached and clear Config, View, Route");
    })->name('clear_all');
    
    Route::get('storage-link', function () {
        \Artisan::call('storage:link');
        dd("storage link created");
    });
});