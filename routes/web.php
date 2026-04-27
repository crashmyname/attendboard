<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use Bpjs\Framework\Helpers\AuthMiddleware;
use Bpjs\Framework\Helpers\Route;
use Bpjs\Framework\Helpers\View;

Route::get('/login',[AuthController::class, 'index'])->name('auth');
Route::post('/auth/login',[AuthController::class, 'login'])->name('auth.login');
Route::get('/',[HomeController::class, 'indexHome'])->name('home');
Route::group([AuthMiddleware::class], function(){
    Route::get('/dashboard',[HomeController::class, 'index'])->name('dashboard');
    Route::post('/auth/logout',[AuthController::class, 'logout'])->name('auth.logout');
});