<?php

use App\Events\MessageSent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TieuChuanController;
use App\Http\Controllers\TieuChiController;
use App\Http\Controllers\NganhController;
use App\Http\Controllers\DonViController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ThongTinCaNhanController;
use App\Http\Controllers\NhomController;
use App\Http\Controllers\DotDanhGiaController;
use App\Http\Controllers\BaoCaoController;
use App\Http\Controllers\NhomNguoiDungController;
use App\Http\Controllers\BinhLuanController;
use App\Http\Controllers\MinhChungController;
use App\Http\Controllers\BaoCaoSaoLuuController;
use App\Http\Controllers\VaiTroHeThongController;
use Illuminate\Http\Request;

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

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('tieuchuan')->group(function () {
        Route::get('/', [TieuChuanController::class, 'index'])->name('tieuchuan.index')->middleware('can:tieuchuan-danhsach');
        Route::get('/create', [TieuChuanController::class, 'create'])->name('tieuchuan.create')->middleware('can:tieuchuan-them');
        Route::post('/store', [TieuChuanController::class, 'store'])->name('tieuchuan.store')->middleware('can:tieuchuan-them');
        Route::get('/edit/{id}', [TieuChuanController::class, 'edit'])->name('tieuchuan.edit')->middleware('can:tieuchuan-sua');
        Route::post('/update/{id}', [TieuChuanController::class, 'update'])->name('tieuchuan.update')->middleware('can:tieuchuan-sua');
        Route::post('/destroy', [TieuChuanController::class, 'destroy'])->name('tieuchuan.destroy')->middleware('can:tieuchuan-xoa');
        Route::get('/trash', [TieuChuanController::class, 'trash'])->name('tieuchuan.trash')->middleware('can:tieuchuan-xoa');
        Route::post('/restore', [TieuChuanController::class, 'restore'])->name('tieuchuan.restore')->middleware('can:tieuchuan-xoa');
        Route::post('/restore-all', [TieuChuanController::class, 'restoreAll'])->name('tieuchuan.restore-all')->middleware('can:tieuchuan-xoa');
        Route::post('/force-destroy', [TieuChuanController::class, 'forceDestroy'])->name('tieuchuan.force-destroy')->middleware('can:tieuchuan-xoa');
        Route::post('/force-destroy-all', [TieuChuanController::class, 'forceDestroyAll'])->name('tieuchuan.force-destroy-all')->middleware('can:tieuchuan-xoa');
    });

    Route::prefix('tieuchi')->group(function () {
        Route::get('/', [TieuChiController::class, 'index'])->name('tieuchi.index')->middleware('can:tieuchi-danhsach');
        Route::get('/create', [TieuChiController::class, 'create'])->name('tieuchi.create')->middleware('can:tieuchi-them');
        Route::post('/store', [TieuChiController::class, 'store'])->name('tieuchi.store')->middleware('can:tieuchi-them');
        Route::get('/show/{id}', [TieuChiController::class, 'show'])->name('tieuchi.show')->middleware('can:tieuchi-chitiet');
        Route::get('/edit/{id}', [TieuChiController::class, 'edit'])->name('tieuchi.edit')->middleware('can:tieuchi-sua');
        Route::post('/update/{id}', [TieuChiController::class, 'update'])->name('tieuchi.update')->middleware('can:tieuchi-sua');
        Route::post('/destroy', [TieuChiController::class, 'destroy'])->name('tieuchi.destroy')->middleware('can:tieuchi-xoa');
        Route::get('/trash', [TieuChiController::class, 'trash'])->name('tieuchi.trash')->middleware('can:tieuchi-xoa');
        Route::post('/restore', [TieuChiController::class, 'restore'])->name('tieuchi.restore')->middleware('can:tieuchi-xoa');
        Route::post('/restore-all', [TieuChiController::class, 'restoreAll'])->name('tieuchi.restore-all')->middleware('can:tieuchi-xoa');
        Route::post('/force-destroy', [TieuChiController::class, 'forceDestroy'])->name('tieuchi.force-destroy')->middleware('can:tieuchi-xoa');
        Route::post('/force-destroy-all', [TieuChiController::class, 'forceDestroyAll'])->name('tieuchi.force-destroy-all')->middleware('can:tieuchi-xoa');
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

    Route::prefix('thongtincanhan')->group(function () {
        Route::get('/', [ThongTinCaNhanController::class, 'show'])->name('thongtincanhan.show');
        Route::get('/edit', [ThongTinCaNhanController::class, 'edit'])->name('thongtincanhan.edit');
        Route::post('/update', [ThongTinCaNhanController::class, 'update'])->name('thongtincanhan.update');
        Route::get('/changepassword', [ThongTinCaNhanController::class, 'changePassword'])->name('thongtincanhan.changepassword');
        Route::post('/savePassword', [ThongTinCaNhanController::class, 'savePassword'])->name('thongtincanhan.savepassword');
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
        Route::get('/word/{id}', [BaoCaoController::class, 'word'])->name('baocao.word');
        Route::post('/backup', [BaoCaoController::class, 'backup'])->name('baocao.backup');
    });

    Route::prefix('nhomnguoidung')->group(function () {
        Route::get('/create', [NhomNguoiDungController::class, 'create'])->name('nhomnguoidung.create');
        Route::post('/store', [NhomNguoiDungController::class, 'store'])->name('nhomnguoidung.store');
        Route::get('/show/{id}', [NhomNguoiDungController::class, 'show'])->name('nhomnguoidung.show');
        Route::get('/edit/{id}', [NhomNguoiDungController::class, 'edit'])->name('nhomnguoidung.edit');
        Route::post('/update/{id}', [NhomNguoiDungController::class, 'update'])->name('nhomnguoidung.update');
        Route::post('/destroy', [NhomNguoiDungController::class, 'destroy'])->name('nhomnguoidung.destroy');
        Route::get('/trash', [NhomNguoiDungController::class, 'trash'])->name('nhomnguoidung.trash');
        Route::post('/restore', [NhomNguoiDungController::class, 'restore'])->name('nhomnguoidung.restore');
        Route::post('/restore-all', [NhomNguoiDungController::class, 'restoreAll'])->name('nhomnguoidung.restore-all');
        Route::post('/force-destroy', [NhomNguoiDungController::class, 'forceDestroy'])->name('nhomnguoidung.force-destroy');
        Route::post('/force-destroy-all', [NhomNguoiDungController::class, 'forceDestroyAll'])->name('nhomnguoidung.force-destroy-all');
    });

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Route::get('/tinymce', function() {
        return view('tinymce');
    });

    Route::prefix('binhluan')->group(function () {
        Route::post('/show', [BinhLuanController::class, 'show'])->name('binhluan.show');
        Route::post('/store', [BinhLuanController::class, 'store'])->name('binhluan.store');
        Route::post('/storeReply', [BinhLuanController::class, 'storeReply'])->name('binhluan.store-reply');
    });

    Route::prefix('minhchung')->group(function () {
        Route::get('/index', [MinhChungController::class, 'index'])->name('minhchung.index');
        Route::get('/create', [MinhChungController::class, 'create'])->name('minhchung.create');
        Route::post('/store', [MinhChungController::class, 'store'])->name('minhchung.store');
        Route::get('/show/{id}', [MinhChungController::class, 'show'])->name('minhchung.show');
        Route::get('/edit/{id}', [MinhChungController::class, 'edit'])->name('minhchung.edit');
        Route::post('/update/{id}', [MinhChungController::class, 'update'])->name('minhchung.update');
        Route::post('/destroy', [MinhChungController::class, 'destroy'])->name('minhchung.destroy');
        Route::get('/trash', [MinhChungController::class, 'trash'])->name('minhchung.trash');
        Route::post('/restore', [MinhChungController::class, 'restore'])->name('minhchung.restore');
        Route::post('/restore-all', [MinhChungController::class, 'restoreAll'])->name('minhchung.restore-all');
        Route::post('/force-destroy', [MinhChungController::class, 'forceDestroy'])->name('minhchung.force-destroy');
        Route::post('/force-destroy-all', [MinhChungController::class, 'forceDestroyAll'])->name('minhchung.force-destroy-all');
        Route::post('/getall', [MinhChungController::class, 'getAll'])->name('minhchung.get-all');
    });

    Route::prefix('baocaosaoluu')->group(function () {
        Route::get('/show/{id}', [BaoCaoSaoLuuController::class, 'show'])->name('baocaosaoluu.show');
        Route::get('/compare/{id}', [BaoCaoSaoLuuController::class, 'compare'])->name('baocaosaoluu.compare');
        Route::post('/destroy', [BaoCaoSaoLuuController::class, 'destroy'])->name('baocaosaoluu.destroy');
        Route::post('/restore', [BaoCaoSaoLuuController::class, 'restore'])->name('baocaosaoluu.restore');
    });

    Route::prefix('vaitrohethong')->group(function () {
        Route::get('/', [VaiTroHeThongController::class, 'index'])->name('vaitrohethong.index');
        Route::get('/create', [VaiTroHeThongController::class, 'create'])->name('vaitrohethong.create');
        Route::post('/store', [VaiTroHeThongController::class, 'store'])->name('vaitrohethong.store');
        Route::get('/edit/{id}', [VaiTroHeThongController::class, 'edit'])->name('vaitrohethong.edit');
        Route::post('/update/{id}', [VaiTroHeThongController::class, 'update'])->name('vaitrohethong.update');
        Route::post('/destroy', [VaiTroHeThongController::class, 'destroy'])->name('vaitrohethong.destroy');
        Route::get('/trash', [VaiTroHeThongController::class, 'trash'])->name('vaitrohethong.trash');
        Route::post('/restore', [VaiTroHeThongController::class, 'restore'])->name('vaitrohethong.restore');
        Route::post('/restore-all', [VaiTroHeThongController::class, 'restoreAll'])->name('vaitrohethong.restore-all');
        Route::post('/force-destroy', [VaiTroHeThongController::class, 'forceDestroy'])->name('vaitrohethong.force-destroy');
        Route::post('/force-destroy-all', [VaiTroHeThongController::class, 'forceDestroyAll'])->name('vaitrohethong.force-destroy-all');
    });

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
});

Route::get('/iframe', function() {
    return view('minhchung');
});



Auth::routes();


