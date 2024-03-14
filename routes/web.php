<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RedirectController;
use App\Livewire\Dashboard;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', Home::class);
Route::get('/register', Register::class);
Route::get('/login', Login::class)->name('login');
Route::get('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');
});
Route::get('/dashboard', Dashboard::class)->middleware('auth');
Route::get('/{back_half}', [RedirectController::class, 'index'])->middleware('auth');
