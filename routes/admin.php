<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompanyValueController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\TimelineItemController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('projects', ProjectController::class);
    Route::delete('projects/{project}/images/{image}', [ProjectController::class, 'destroyImage'])
        ->name('projects.images.destroy');

    // About Page Content
    Route::resource('team', TeamMemberController::class);
    Route::resource('timeline', TimelineItemController::class);
    Route::resource('values', CompanyValueController::class);

    // Contact Messages
    Route::resource('messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);

    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
});
