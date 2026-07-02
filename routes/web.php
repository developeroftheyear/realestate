<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('panel.dashboard');
    }

    return redirect()->route('properties.index');
})->middleware(['auth'])->name('dashboard');

Route::redirect('/admin', '/panel')->middleware(['auth', 'admin']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/inbox', [\App\Http\Controllers\Frontend\InboxController::class, 'index'])->name('inbox.index');
    Route::get('/inbox/{contactMessage}', [\App\Http\Controllers\Frontend\InboxController::class, 'show'])->name('inbox.show');
});

require __DIR__.'/auth.php';

// Custom Frontend Routes
use App\Http\Controllers\Frontend\PropertyController;
use App\Http\Controllers\Frontend\RentController;
use App\Http\Controllers\Frontend\ContactController;

Route::get('/', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/rent', [RentController::class, 'index'])->name('rent.index');
Route::get('/rent/search', [RentController::class, 'search'])->name('rent.search');
Route::get('/rent/{id}', [RentController::class, 'show'])->name('rent.show');

Route::get('/buy', [PropertyController::class, 'buy'])->name('buy.index');
Route::get('/buy/{id}', [PropertyController::class, 'show'])->name('buy.show');
Route::get('/sell', [PropertyController::class, 'sell'])->name('sell.index');
Route::post('/sell', [PropertyController::class, 'submitSell'])->name('sell.submit');
Route::get('/agent-finder', [PropertyController::class, 'agentFinder'])->name('agent.finder');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Custom Dashboard Routes
use App\Http\Controllers\Dashboard\ContactMessageController as DashboardContactMessageController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\PropertyController as DashboardPropertyController;
use App\Http\Controllers\Dashboard\RentPropertyController as DashboardRentPropertyController;
use App\Http\Controllers\Dashboard\AgentController as DashboardAgentController;

Route::prefix('panel')->name('panel.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('properties', DashboardPropertyController::class);
    Route::resource('rent-properties', DashboardRentPropertyController::class);
    Route::resource('agents', DashboardAgentController::class);
    Route::resource('contact-messages', DashboardContactMessageController::class)->only(['index', 'show', 'destroy']);
    Route::post('contact-messages/{contact_message}/reply', [DashboardContactMessageController::class, 'reply'])->name('contact-messages.reply');
});
