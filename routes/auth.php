<?php

// Laravel Fortify handles authentication routes automatically
// This file exists as a placeholder for custom auth routes if needed

use Illuminate\Support\Facades\Route;

// Logout route (if Fortify doesn't handle it via blade)
Route::post('logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->middleware('auth')->name('logout');
