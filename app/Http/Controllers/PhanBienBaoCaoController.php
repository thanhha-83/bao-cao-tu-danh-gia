<?php

namespace App\Http\Controllers;

use App\Models\BaoCao;
use App\Models\BaoCaoSaoLuu;
use App\Models\Nganh;
use App\Models\NguoiDungQuyen;
use App\Models\Nhom;
use App\Models\NhomNguoiDung;
use App\Models\NhomQuyen;
use App\Models\TieuChi;
use App\Models\TieuChuan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PhanBienBaoCaoController extends Controller
{
    private $baoCaoModel;
    private $nganhModel;
    private $tieuChuanModel;
    private $tieuChiModel;
    private $baoCaoSLModel;
    private $nhomNguoiDungModel;
    private $nguoiDungQuyenModel;
    private $nhomQuyenModel;
    private $nhomModel;
    public function __construct(BaoCao $baoCaoModel, Nganh $nganhModel, TieuChuan $tieuChuanModel, TieuChi $tieuChiModel, BaoCaoSaoLuu $baoCaoSLModel, NhomNguoiDung $nhomNguoiDungModel, NguoiDungQuyen $nguoiDungQuyenModel, NhomQuyen $nhomQuyenModel, Nhom $nhomModel)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->baoCaoModel = $baoCaoModel;
        $this->nganhModel = $nganhModel;
        $this->tieuChuanModel = $tieuChuanModel;
        $this->tieuChiModel = $tieuChiModel;
        $this->baoCaoSLModel = $baoCaoSLModel;
        $this->nhomNguoiDungModel = $nhomNguoiDungModel;
        $this->nguoiDungQuyenModel = $nguoiDungQuyenModel;
        $this->nhomQuyenModel = $nhomQuyenModel;
        $this->nhomModel = $nhomModel;
    }

    public function index()
    {
        $user = auth()->user();
        $nhomNguoiDungs = $this->nhomNguoiDungModel->where('nguoiDung_id', $user->id)->get();
        $nhomIds = [];
        foreach ($nhomNguoiDungs as $nhomNguoiDung) {
            array_push($nhomIds, $nhomNguoiDung->nhom_id);
        }
        $sameNhomNguoiDungs = $this->nhomNguoiDungModel->whereIn('nhom_id', $nhomIds)->get();
        $nhomNguoiDungIds = [];
        foreach ($sameNhomNguoiDungs as $nhomNguoiDung) {
            array_push($nhomNguoiDungIds, $nhomNguoiDung->id);
        }
        $nguoiDungQuyens = $this->nguoiDungQuyenModel->whereIn('nhomNguoiDung_id', $nhomNguoiDungIds)->get();
        $baoCaoIds = [];
        foreach ($nguoiDungQuyens as $nguoiDungQuyen) {
            if ($nguoiDungQuyen->quyenNguoiDung_id == 3) {
                array_push($baoCaoIds, $nguoiDungQuyen->baoCao_id);
            }
        }
        $baoCaos = $this->baoCaoModel->whereIn('id', $baoCaoIds)->get();
        return view('pages.phanbienbaocao.index', compact('baoCaos'));
    }

    public function show($id)
    {
        $baoCao = $this->baoCaoModel->find($id);
        return view('pages.phanbienbaocao.show', compact('baoCao'));
    }
}
