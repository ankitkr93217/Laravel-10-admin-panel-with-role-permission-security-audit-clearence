<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\web\AuthController;
use App\Http\Controllers\web\ReactionFromDrugController;
use App\Http\Controllers\web\ReactionFromMedicalDeviceController;


use App\Http\Controllers\web\UserController;



use Illuminate\Support\Facades\Artisan;

 
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    dd('done');
});
Route::get('refresh_captcha', [AuthController::class, 'refreshCaptcha'])->name('refresh_captcha');

 
Route::get('admin/login', [AuthController::class, 'index'])->name('login');
Route::get('lock-account', [AuthController::class, 'locked_account'])->name('locked_account');

Route::prefix('admin/auth')->middleware(['guest:web'])->group(function () {
    Route::post('postLogin', [AuthController::class, 'postLogin'])->name('postLogin'); 
});
Route::prefix('admin/auth')->middleware(['auth:web'])->group(function () {
     Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
});
Route::prefix('admin/')->middleware(['auth:web'])->group(function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard'); 
});

//user management
 
Route::prefix('admin/user')->middleware(['auth:web','web'])->group(function () {
    Route::match(['get','post'],'create_user', [UserController::class, 'create_user'])->name('create_user'); 
    Route::get('user_list', [UserController::class, 'user_list'])->name('user_list'); 
    Route::match(['get','post'],'user_edit/{id?}', [UserController::class, 'user_edit'])->name('user_edit'); 

    

});

Route::prefix('reactionFromDrug')->middleware(['auth:web','web'])->group(function () {
    Route::get('consumer_side_effect_list', [ReactionFromDrugController::class, 'consumerSideEffectList'])->name('consumerSideEffectList'); 
    Route::get('voluntryReportingList', [ReactionFromDrugController::class, 'voluntryReportingList'])->name('voluntryReportingList'); 

});

Route::prefix('reactionFromMedicalDevice')->middleware(['auth:web','web'])->group(function () {
    Route::get('consumerMedicalDeviceList', [ReactionFromMedicalDeviceController::class, 'consumerMedicalDeviceList'])->name('consumerMedicalDeviceList'); 
    Route::get('voluntryMedicalDeviceList', [ReactionFromMedicalDeviceController::class, 'voluntryMedicalDeviceList'])->name('voluntryMedicalDeviceList'); 

});
 
Route::prefix('admin/user')->middleware(['auth:web','web'])->group(function () {
    Route::match(['get','post'],'create_user', [UserController::class, 'create_user'])->name('create_user'); 
    Route::get('user_list', [UserController::class, 'user_list'])->name('user_list'); 

});
 
