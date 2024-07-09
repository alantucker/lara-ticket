<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', UserDashboard::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tickets', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('ticket.create');
    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('ticket.show');
    Route::post('/tickets', [TicketController::class, 'store'])->name('ticket.store');
    Route::post('/tickets/{id}', [TicketController::class, 'close'])->name('ticket.close');

    Route::post('/replies', [ReplyController::class, 'store'])->name('reply.store');
    Route::get('/replies/create', [ReplyController::class, 'create'])->name('reply.create');

});

require __DIR__.'/auth.php';
