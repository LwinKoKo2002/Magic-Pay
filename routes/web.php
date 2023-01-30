<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Frontend\NotificationController;

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
    Route::get('/transfer', [PageController::class,'transfer'])->name('transfer');
    Route::get('/receiver-account-verify', [PageController::class,'verifyReceiver']);
    Route::post('/transfer/confirm', [PageController::class,'transferConfirm'])->name('transfer.confirm');
    Route::post('/transfer/complete', [PageController::class,'transferComplete'])->name('transfer.complete');
    Route::get('/password-check', [PageController::class,'passwordCheck']);
    Route::get('/scan-and-pay', [PageController::class,'scanAndPay'])->name('scanAndPay');
    Route::get('/scan-and-pay-form', [PageController::class,'scanAndPayForm'])->name('scan-and-pay-form');
    Route::get('/qr-code', [PageController::class,'myReceiveQr'])->name('myQr');
    Route::get('/transaction', [PageController::class,'transaction'])->name('transaction');
    Route::get('/transaction/{trx_id}', [PageController::class,'transactionDetail']);
    Route::get('/notification', [NotificationController::class,'index'])->name('notification');
    Route::get('/notification/{noti_id}', [NotificationController::class,'show'])->name('notification-detail');
    Route::post('/notifications/{noti_id}/delete', [NotificationController::class,'destroy']);
    Route::post('/notifications/{noti_id}/unreadnotification/update', [NotificationController::class,'unReadNotiUpdate']);
    Route::post('/notifications/{noti_id}/readnotification/update', [NotificationController::class,'readNotiUpdate']);
});
