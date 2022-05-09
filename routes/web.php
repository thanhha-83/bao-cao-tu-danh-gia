<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TieuChuanController;
use App\Http\Controllers\TieuChiController;
use App\Http\Controllers\NganhController;
use App\Http\Controllers\DonViController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NhomController;
use App\Http\Controllers\DotDanhGiaController;
use App\Http\Controllers\BaoCaoController;

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

Route::prefix('nhom')->group(function () {
    Route::get('/', [NhomController::class, 'index'])->name('nhom.index');
    Route::get('/create', [NhomController::class, 'create'])->name('nhom.create');
    Route::post('/store', [NhomController::class, 'store'])->name('nhom.store');
    Route::get('/show/{id}', [NhomController::class, 'show'])->name('nhom.show');
    Route::get('/edit/{id}', [NhomController::class, 'edit'])->name('nhom.edit');
    Route::post('/update/{id}', [NhomController::class, 'update'])->name('nhom.update');
    Route::post('/destroy', [NhomController::class, 'destroy'])->name('nhom.destroy');
    Route::get('/trash', [NhomController::class, 'trash'])->name('nhom.trash');
    Route::post('/restore', [NhomController::class, 'restore'])->name('nhom.restore');
    Route::post('/restore-all', [NhomController::class, 'restoreAll'])->name('nhom.restore-all');
    Route::post('/force-destroy', [NhomController::class, 'forceDestroy'])->name('nhom.force-destroy');
    Route::post('/force-destroy-all', [NhomController::class, 'forceDestroyAll'])->name('nhom.force-destroy-all');
});

Route::prefix('dotdanhgia')->group(function () {
    Route::get('/', [DotDanhGiaController::class, 'index'])->name('dotdanhgia.index');
    Route::get('/create', [DotDanhGiaController::class, 'create'])->name('dotdanhgia.create');
    Route::post('/store', [DotDanhGiaController::class, 'store'])->name('dotdanhgia.store');
    Route::get('/show/{id}', [DotDanhGiaController::class, 'show'])->name('dotdanhgia.show');
    Route::get('/edit/{id}', [DotDanhGiaController::class, 'edit'])->name('dotdanhgia.edit');
    Route::post('/update/{id}', [DotDanhGiaController::class, 'update'])->name('dotdanhgia.update');
    Route::post('/destroy', [DotDanhGiaController::class, 'destroy'])->name('dotdanhgia.destroy');
    Route::get('/trash', [DotDanhGiaController::class, 'trash'])->name('dotdanhgia.trash');
    Route::post('/restore', [DotDanhGiaController::class, 'restore'])->name('dotdanhgia.restore');
    Route::post('/restore-all', [DotDanhGiaController::class, 'restoreAll'])->name('dotdanhgia.restore-all');
    Route::post('/force-destroy', [DotDanhGiaController::class, 'forceDestroy'])->name('dotdanhgia.force-destroy');
    Route::post('/force-destroy-all', [DotDanhGiaController::class, 'forceDestroyAll'])->name('dotdanhgia.force-destroy-all');
});

Route::prefix('baocao')->group(function () {
    Route::get('/', [BaoCaoController::class, 'index'])->name('baocao.index');
    Route::get('/create', [BaoCaoController::class, 'create'])->name('baocao.create');
    Route::post('/store', [BaoCaoController::class, 'store'])->name('baocao.store');
    Route::get('/show/{id}', [BaoCaoController::class, 'show'])->name('baocao.show');
    Route::get('/edit/{id}', [BaoCaoController::class, 'edit'])->name('baocao.edit');
    Route::post('/update/{id}', [BaoCaoController::class, 'update'])->name('baocao.update');
    Route::post('/destroy', [BaoCaoController::class, 'destroy'])->name('baocao.destroy');
    Route::get('/trash', [BaoCaoController::class, 'trash'])->name('baocao.trash');
    Route::post('/restore', [BaoCaoController::class, 'restore'])->name('baocao.restore');
    Route::post('/restore-all', [BaoCaoController::class, 'restoreAll'])->name('baocao.restore-all');
    Route::post('/force-destroy', [BaoCaoController::class, 'forceDestroy'])->name('baocao.force-destroy');
    Route::post('/force-destroy-all', [BaoCaoController::class, 'forceDestroyAll'])->name('baocao.force-destroy-all');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/tinymce', function() {
    return view('tinymce');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
