<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPropertyController;
use App\Http\Controllers\AdminRentPropertyController;
use App\Http\Controllers\AdminAgentController;
use App\Http\Controllers\AuthController;
Route::get('/', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/rent', [RentController::class, 'index'])->name('rent.index');
Route::get('/rent/{id}', [RentController::class, 'show'])->name('rent.show');
Route::get('/rent/search', [RentController::class, 'search'])->name('rent.search');

Route::get('/buy', [PropertyController::class, 'buy'])->name('buy.index');
Route::get('/buy/{id}', [PropertyController::class, 'show'])->name('buy.show');
Route::get('/sell', [PropertyController::class, 'sell'])->name('sell.index');
Route::post('/sell', [PropertyController::class, 'submitSell'])->name('sell.submit');
Route::get('/agent-finder', [PropertyController::class, 'agentFinder'])->name('agent.finder');

Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('properties', AdminPropertyController::class);
    Route::resource('rent-properties', AdminRentPropertyController::class);
    Route::resource('agents', AdminAgentController::class);
});