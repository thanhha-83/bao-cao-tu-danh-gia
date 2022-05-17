<?php

namespace App\Http\Controllers;

use App\Models\BaoCao;
use App\Models\Nganh;
use App\Models\NguoiDungQuyen;
use App\Models\Nhom;
use App\Models\NhomNguoiDung;
use App\Models\NhomQuyen;
use App\Models\QuyenNguoiDung;
use App\Models\QuyenNhom;
use App\Models\TieuChuan;
use App\Models\User;
use App\Models\VaiTro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\HandleUpdate3Many;

class NhomNguoiDungController extends Controller
{
    private $nhomModel;
    private $nganhModel;
    private $quyenNhomModel;
    private $tieuChuanModel;
    private $nhomQuyenModel;
    private $userModel;
    private $nhomNguoiDungModel;
    private $nguoiDungQuyenModel;
    private $quyenNguoiDungModel;
    private $vaiTroModel;
    private $baoCaoModel;
    public function __construct(Nhom $nhomModel, Nganh $nganhModel, QuyenNhom $quyenNhomModel, TieuChuan $tieuChuanModel, NhomQuyen $nhomQuyenModel, User $userModel, NhomNguoiDung $nhomNguoiDungModel, NguoiDungQuyen $nguoiDungQuyenModel, QuyenNguoiDung $quyenNguoiDungModel, VaiTro $vaiTroModel, BaoCao $baoCaoModel)
    {
        $this->nhomModel = $nhomModel;
        $this->nganhModel = $nganhModel;
        $this->quyenNhomModel = $quyenNhomModel;
        $this->tieuChuanModel = $tieuChuanModel;
        $this->nhomQuyenModel = $nhomQuyenModel;
        $this->userModel = $userModel;
        $this->nhomNguoiDungModel = $nhomNguoiDungModel;
        $this->nguoiDungQuyenModel = $nguoiDungQuyenModel;
        $this->quyenNguoiDungModel = $quyenNguoiDungModel;
        $this->vaiTroModel = $vaiTroModel;
        $this->baoCaoModel = $baoCaoModel;
    }

    public function show($id)
    {
        $nhomNguoiDungs = $this->nhomNguoiDungModel->where('nhom_id', $id)->get();
        return view('pages.nhomnguoidung.show', compact('nhomNguoiDungs'));
    }
    public function edit($id)
    {
        $nhomNguoiDung = $this->nhomNguoiDungModel->find($id);
        $vaiTros = $this->vaiTroModel->all();
        $quyenNguoiDungs = $this->quyenNguoiDungModel->all();
        $baoCaos = $this->baoCaoModel->all();
        return view('pages.nhomnguoidung.edit', compact('nhomNguoiDung', 'vaiTros', 'quyenNguoiDungs', 'baoCaos'));
    }
}
