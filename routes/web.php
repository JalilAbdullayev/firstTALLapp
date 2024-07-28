<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');
Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');
Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

Route::prefix('notes')->name('notes.')->group(function() {
    Route::view('/', 'notes.index')->name('index');
    Route::view('create', 'notes.create')->name('create');
});

Volt::route('notes/{note}/edit', 'notes.edit-note')->name('notes.edit');

require __DIR__ . '/auth.php';
