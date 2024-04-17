<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/v1/auth/register', function () {
    return view('auth.register');
});
Route::get('/v1/auth/login', function () {
    return view('auth.login');
});
Route::post('/v1/auth/register', [RegisterController::class, 'register'])->name('register');
Route::post('/v1/auth/login', [LoginController::class, 'login'])->name('login');

Route::middleware(['report'])->group(function () {
    Route::get('/v1/websites', [WebsiteController::class, 'index'])->name('website.index');
    Route::get('/v1/websites/create', [WebsiteController::class, 'create'])->name('website.create');
    Route::post('/v1/websites', [WebsiteController::class, 'store'])->name('website.store');
    Route::get('/v1/websites/{id}', [WebsiteController::class, 'show'])->name('website.show');
    Route::get('/v1/websites/{id}/edit', [WebsiteController::class, 'edit'])->name('website.edit');
    Route::patch('/v1/websites/{id}', [WebsiteController::class, 'update'])->name('website.update');
    Route::delete('/v1/websites/{id}', [WebsiteController::class, 'destroy'])->name('website.destroy');

    Route::get('/v1/report', [ReportController::class, 'index']);
    Route::get('/v1/websites/{id}/report', [ReportController::class, 'show']);
});
