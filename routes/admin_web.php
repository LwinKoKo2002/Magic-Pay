<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\WalletController;
use App\Http\Controllers\Backend\AdminUserController;

Route::prefix('admin')->middleware('auth:admin_web')->name('admin.')->group(function () {
    Route::get('/', [PageController::class,'index'])->name('home');
    Route::resource('admin-user', AdminUserController::class);
    Route::get('/admin-user/datatable/ssd', [AdminUserController::class,'ssd'])->name('admin-user.datatable');
    Route::resource('user', UserController::class);
    Route::get('/user/datatable/ssd', [UserController::class,'ssd'])->name('user.datatable');
    Route::get('/wallet', [WalletController::class,'index']);
    Route::get('/user/wallet/datatable/ssd', [WalletController::class,'ssd']);
});
