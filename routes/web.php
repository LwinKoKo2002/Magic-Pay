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
});
