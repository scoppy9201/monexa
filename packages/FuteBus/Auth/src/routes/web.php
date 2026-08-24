<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (): void {
    Route::view('/dang-nhap', 'Auth::login')->name('login');
    Route::view('/dang-ky', 'Auth::register')->name('register');
    Route::view('/quen-mat-khau', 'Auth::forgot-password')->name('password.request');
});
