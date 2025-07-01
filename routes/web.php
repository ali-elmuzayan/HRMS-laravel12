<?php

use App\Http\Controllers\User\SettingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});




// the dashboard routes
Route::middleware(['auth'/*, 'verified'*/])->group(function () {
    // general settings
    Route::get('/tenant/settings', [SettingController::class, 'index'])->name('tenant.settings.index');
    Route::get('/tenant/settings/edit', [SettingController::class, 'edit'])->name('tenant.settings.edit');
    Route::put('/tenant/settings/update', [SettingController::class, 'update'])->name('tenant.settings.update');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
