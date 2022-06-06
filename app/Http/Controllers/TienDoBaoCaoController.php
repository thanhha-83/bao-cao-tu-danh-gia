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

class TienDoBaoCaoController extends Controller
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
        return view('pages.tiendobaocao.index');
    }
}
