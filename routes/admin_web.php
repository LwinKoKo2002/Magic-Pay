<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\AdminUserController;

Route::prefix('admin')->middleware('auth:admin_web')->name('admin.')->group(function () {
    Route::get('/', [PageController::class,'index'])->name('home');
    Route::resource('admin-user', AdminUserController::class);
    Route::get('/admin-user/datatable/ssd', [AdminUserController::class,'ssd'])->name('admin-user.datatable');
    Route::resource('user', UserController::class);
});
