<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TieuChuanController;
use App\Http\Controllers\TieuChiController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
