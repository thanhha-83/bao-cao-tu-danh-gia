<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TieuChuanController;
use App\Http\Controllers\TieuChiController;
use App\Http\Controllers\NganhController;
use App\Http\Controllers\DonViController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('tieuchuan')->group(function () {
    Route::get('/', [TieuChuanController::class, 'index'])->name('tieuchuan.index');
    Route::get('/create', [TieuChuanController::class, 'create'])->name('tieuchuan.create');
    Route::post('/store', [TieuChuanController::class, 'store'])->name('tieuchuan.store');
    Route::get('/show/{id}', [TieuChuanController::class, 'show'])->name('tieuchuan.show');
    Route::get('/edit/{id}', [TieuChuanController::class, 'edit'])->name('tieuchuan.edit');
    Route::post('/update/{id}', [TieuChuanController::class, 'update'])->name('tieuchuan.update');
    Route::post('/destroy', [TieuChuanController::class, 'destroy'])->name('tieuchuan.destroy');
    Route::get('/trash', [TieuChuanController::class, 'trash'])->name('tieuchuan.trash');
    Route::post('/restore', [TieuChuanController::class, 'restore'])->name('tieuchuan.restore');
    Route::post('/restore-all', [TieuChuanController::class, 'restoreAll'])->name('tieuchuan.restore-all');
    Route::post('/force-destroy', [TieuChuanController::class, 'forceDestroy'])->name('tieuchuan.force-destroy');
    Route::post('/force-destroy-all', [TieuChuanController::class, 'forceDestroyAll'])->name('tieuchuan.force-destroy-all');
});

Route::prefix('tieuchi')->group(function () {
    Route::get('/', [TieuChiController::class, 'index'])->name('tieuchi.index');
    Route::get('/create', [TieuChiController::class, 'create'])->name('tieuchi.create');
    Route::post('/store', [TieuChiController::class, 'store'])->name('tieuchi.store');
    Route::get('/show/{id}', [TieuChiController::class, 'show'])->name('tieuchi.show');
    Route::get('/edit/{id}', [TieuChiController::class, 'edit'])->name('tieuchi.edit');
    Route::post('/update/{id}', [TieuChiController::class, 'update'])->name('tieuchi.update');
    Route::post('/destroy', [TieuChiController::class, 'destroy'])->name('tieuchi.destroy');
    Route::get('/trash', [TieuChiController::class, 'trash'])->name('tieuchi.trash');
    Route::post('/restore', [TieuChiController::class, 'restore'])->name('tieuchi.restore');
    Route::post('/restore-all', [TieuChiController::class, 'restoreAll'])->name('tieuchi.restore-all');
    Route::post('/force-destroy', [TieuChiController::class, 'forceDestroy'])->name('tieuchi.force-destroy');
    Route::post('/force-destroy-all', [TieuChiController::class, 'forceDestroyAll'])->name('tieuchi.force-destroy-all');
});

Route::prefix('nganh')->group(function () {
    Route::get('/', [NganhController::class, 'index'])->name('nganh.index');
    Route::get('/create', [NganhController::class, 'create'])->name('nganh.create');
    Route::post('/store', [NganhController::class, 'store'])->name('nganh.store');
    Route::get('/edit/{id}', [NganhController::class, 'edit'])->name('nganh.edit');
    Route::post('/update/{id}', [NganhController::class, 'update'])->name('nganh.update');
    Route::post('/destroy', [NganhController::class, 'destroy'])->name('nganh.destroy');
    Route::get('/trash', [NganhController::class, 'trash'])->name('nganh.trash');
    Route::post('/restore', [NganhController::class, 'restore'])->name('nganh.restore');
    Route::post('/restore-all', [NganhController::class, 'restoreAll'])->name('nganh.restore-all');
    Route::post('/force-destroy', [NganhController::class, 'forceDestroy'])->name('nganh.force-destroy');
    Route::post('/force-destroy-all', [NganhController::class, 'forceDestroyAll'])->name('nganh.force-destroy-all');
});

Route::prefix('donvi')->group(function () {
    Route::get('/', [DonViController::class, 'index'])->name('donvi.index');
    Route::get('/create', [DonViController::class, 'create'])->name('donvi.create');
    Route::post('/store', [DonViController::class, 'store'])->name('donvi.store');
    Route::get('/edit/{id}', [DonViController::class, 'edit'])->name('donvi.edit');
    Route::post('/update/{id}', [DonViController::class, 'update'])->name('donvi.update');
    Route::post('/destroy', [DonViController::class, 'destroy'])->name('donvi.destroy');
    Route::get('/trash', [DonViController::class, 'trash'])->name('donvi.trash');
    Route::post('/restore', [DonViController::class, 'restore'])->name('donvi.restore');
    Route::post('/restore-all', [DonViController::class, 'restoreAll'])->name('donvi.restore-all');
    Route::post('/force-destroy', [DonViController::class, 'forceDestroy'])->name('donvi.force-destroy');
    Route::post('/force-destroy-all', [DonViController::class, 'forceDestroyAll'])->name('donvi.force-destroy-all');
});

Route::prefix('nguoidung')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('nguoidung.index');
    Route::get('/create', [UserController::class, 'create'])->name('nguoidung.create');
    Route::post('/store', [UserController::class, 'store'])->name('nguoidung.store');
    Route::get('/show/{id}', [UserController::class, 'show'])->name('nguoidung.show');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('nguoidung.edit');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('nguoidung.update');
    Route::post('/destroy', [UserController::class, 'destroy'])->name('nguoidung.destroy');
    Route::get('/trash', [UserController::class, 'trash'])->name('nguoidung.trash');
    Route::post('/restore', [UserController::class, 'restore'])->name('nguoidung.restore');
    Route::post('/restore-all', [UserController::class, 'restoreAll'])->name('nguoidung.restore-all');
    Route::post('/force-destroy', [UserController::class, 'forceDestroy'])->name('nguoidung.force-destroy');
    Route::post('/force-destroy-all', [UserController::class, 'forceDestroyAll'])->name('nguoidung.force-destroy-all');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
