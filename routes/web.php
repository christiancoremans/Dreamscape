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

// Admin routes (admin only)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', App\Livewire\Admin\Dashboard::class)->name('admin.dashboard');
    
    // User management
    Route::get('/users', App\Livewire\Admin\Users\Index::class)->name('admin.users.index');
    Route::get('/users/create', App\Livewire\Admin\Users\Create::class)->name('admin.users.create');
    
    // Item management
    Route::get('/items', App\Livewire\Admin\Items\Index::class)->name('admin.items.index');
    Route::get('/items/create', App\Livewire\Admin\Items\Create::class)->name('admin.items.create');
    Route::get('/items/{id}/edit', App\Livewire\Admin\Items\Edit::class)->name('admin.items.edit');
    
    // Inventory management
    Route::get('/inventory/assign', App\Livewire\Admin\Inventory\Assign::class)->name('admin.inventory.assign');
    
    // Statistics
    Route::get('/statistics', App\Livewire\Admin\Statistics::class)->name('admin.statistics');
});

require __DIR__.'/settings.php';
