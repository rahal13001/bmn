<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicRoomController;
use App\Http\Controllers\PublicGoodController;

Route::get('/', \App\Livewire\PublicLandingPage::class)->name('home');

Route::get('/rooms/{room}/inventory', [PublicRoomController::class, 'show'])->name('public.room.inventory');
Route::get('/goods/{good}/detail', [PublicGoodController::class, 'show'])->name('public.good.detail');
