<?php

use App\Models\Note;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Livewire\Volt\Volt;
use Illuminate\View\View as Viewable;

Route::view('/', 'welcome');
Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');
Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

Route::prefix('notes')->name('notes.')->middleware(['auth'])->group(function() {
    Route::view('/', 'notes.index')->name('index');
    Route::view('create', 'notes.create')->name('create');
    Route::get('{note}', function(Note $note): Viewable {
        if(!$note->is_published) {
            abort(404);
        }
        $user = $note->user;
        return View::make('notes.view', compact('note', 'user'));
    })->name('view');
});

Volt::route('notes/{note}/edit', 'notes.edit-note')->middleware(['auth'])->name('notes.edit');

require __DIR__ . '/auth.php';
