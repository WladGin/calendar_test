<?php

use App\Http\API\Controllers\ApiEventController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function (){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/calendar', [\App\Http\Controllers\EventController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/events', [ApiEventController::class, 'index'])->name('api.calendar.index');
    Route::post('/calendar/create-event', [ApiEventController::class, 'create'])->name('api.calendar.create');
    Route::patch('/calendar/edit-event', [ApiEventController::class, 'edit'])->name('api.calendar.edit');
    Route::delete('/calendar/remove-event', [ApiEventController::class, 'destroy'])->name('api.calendar.destroy');
});
