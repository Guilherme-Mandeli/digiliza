<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/admin/screens/schedules/show/{id}', 'Admin\ScreensController@show')->name('admin.screens.show');

Route::post('/get-schedules', [ScheduleController::class, 'getSchedules'])->name('get-schedules');