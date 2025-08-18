<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard/user', function () {
    return view('dashboard.user.index');
})->middleware(['auth', 'verified'])->name('dashboard.user');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

########### client Management #######################
Route::resource('clients', ClientController::class)
    ->middleware(['auth', 'verified'])
    ->names('clients');

########### Account Management ################

Route::resource('accounts', AccountController::class)
    ->middleware(['auth', 'verified'])
    ->names('accounts');
Route::get('/accounts/{id}/data', [AccountController::class, 'getAccountData']);

########### Subscription Management ################
Route::resource('subscriptions', SubscriptionController::class)
    ->middleware(['auth', 'verified'])
    ->names('subscriptions');
########### Statuses Management ################
Route::resource('statuses', StatusController::class)
    ->middleware(['auth', 'verified'])
    ->names('statuses');


require __DIR__.'/auth.php';
