<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RentController;

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