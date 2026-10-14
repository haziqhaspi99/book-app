<?php

use App\Livewire\QueueDisplay;
use App\Livewire\StaffDashboard;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/dashboard/staff', StaffDashboard::class)
    ->middleware(['auth']);

Route::get('/display', QueueDisplay::class);
require __DIR__.'/auth.php';
