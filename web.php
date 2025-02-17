<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin/dashboard', function () {
    if (session('user_role') != 'admin') {
        return redirect('/login')->withErrors(['access' => 'Anda tidak memiliki akses.']);
    }
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/kasir/dashboard', function () {
    if (session('user_role') != 'kasir') {
        return redirect('/login')->withErrors(['access' => 'Anda tidak memiliki akses.']);
    }
    return view('kasir.dashboard');
})->name('kasir.dashboard');

Route::get('/',function(){
    return redirect() -> route('login');
});

Route::middleware('auth', 'role:admin')->group(function(){
    Route::get('/admin/dashboard', function(){
        return view('admin.dashboard');
    });
});
