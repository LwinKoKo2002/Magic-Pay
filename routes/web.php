<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Auth\AdminLoginController;

//User Auth
Auth::routes();

//Admin Auth
Route::get('/admin/login', [AdminLoginController::class,'showLoginForm']);
Route::post('/admin/login', [AdminLoginController::class,'login'])->name('admin.login');
Route::post('/admin/logout', [AdminLoginController::class,'logout'])->name('admin.logout');

//Home Page
Route::namespace('Frontend')->middleware('auth:web')->group(function () {
    Route::get('/', [PageController::class,'index'])->name('home');
    Route::get('/profile', [PageController::class,'profile'])->name('profile');
    Route::get('/change-password', [PageController::class,'changePassword'])->name('changePassword');
    Route::post('/change-password', [PageController::class,'updatePassword'])->name('update-password');
    Route::get('/wallet', [PageController::class,'wallet'])->name('wallet');
});
