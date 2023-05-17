<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Redirect;

// HOME
Route::get('/', function () {
    return view('site.screens.home');
})->name('site.screens.home');
Route::post('/', [ScheduleController::class, 'store']);

// DASHBOARD
Route::get('/dashboard/novo', [ScheduleController::class, 'create']);
Route::post('/dashboard/novo', [ScheduleController::class, 'store']);
Route::get('/get-schedule', [ScheduleController::class, 'getSchedules']);
Route::delete('/dashboard/{id}/cancel', [ScheduleController::class, 'cancelSchedule']);


// LOGIN E REGISTER
Route::get('/login', function () {
    return Redirect::to('/');
})->name('login');
Route::get('/register', function () {
    return Redirect::to('/');
})->name('register');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.screens.schedules.index');
    })->name('dashboard');
    Route::get('/dashboard/{id}', [ScheduleController::class, 'show'])
        ->name('admin.screens.schedules.show')
        ->where('id', '.*');
});

// E-MAIL
Route::post('/send-email', [ContactController::class, 'sendEmail'])->name('send-email');