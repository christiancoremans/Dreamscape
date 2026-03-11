<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

// Items routes (public)
Route::get('/items', App\Livewire\Items\Index::class)->name('items.index');
Route::get('/items/{id}', App\Livewire\Items\Show::class)->name('items.show');

Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    
    // Inventory routes (authenticated only)
    Route::get('/inventory', App\Livewire\Inventory\Index::class)->name('inventory.index');
    
    // Trade routes (authenticated only)
    Route::get('/trades', App\Livewire\Trades\Index::class)->name('trades.index');
    Route::get('/trades/create', App\Livewire\Trades\Create::class)->name('trades.create');
    Route::get('/trades/{id}', App\Livewire\Trades\Show::class)->name('trades.show');
});

require __DIR__.'/settings.php';
