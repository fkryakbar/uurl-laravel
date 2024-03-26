<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RedirectController;
use App\Livewire\About;
use App\Livewire\Dashboard;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', Home::class);
Route::get('/register', Register::class);
Route::get('/about', About::class);
Route::get('/login', Login::class)->name('login');
Route::get('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');
});

Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/google/callback', function () {
    $auth = Socialite::driver('google')->user();
    // dd($auth);
    $user = User::updateOrCreate([
        'email' => $auth->email,
    ], [
        'name' => $auth->name,
        'email' => $auth->email,
        'password' => bcrypt(123)
    ]);

    Auth::login($user);

    return redirect('/dashboard');
});

Route::get('/dashboard', Dashboard::class)->middleware('auth');
Route::get('/{back_half}', [RedirectController::class, 'index']);
