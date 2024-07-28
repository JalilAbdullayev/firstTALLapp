<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');
Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

Route::prefix('notes')->name('notes.')->group(function() {
    Route::view('/', 'notes.index')->name('index');
    Route::view('create', 'notes.create')->name('create');
});

require __DIR__ . '/auth.php';
