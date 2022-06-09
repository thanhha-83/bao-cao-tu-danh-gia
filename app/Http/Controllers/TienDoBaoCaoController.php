<?php

namespace App\Http\Controllers;

use App\Models\BaoCao;
use App\Models\BaoCaoSaoLuu;
use App\Models\DotDanhGia;
use App\Models\Nganh;
use App\Models\NguoiDungQuyen;
use App\Models\Nhom;
use App\Models\NhomNguoiDung;
use App\Models\NhomQuyen;
use App\Models\TieuChi;
use App\Models\TieuChuan;
use App\Models\User;
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
    private $userModel;
    public function __construct(User $userModel, BaoCao $baoCaoModel, Nganh $nganhModel, TieuChuan $tieuChuanModel, TieuChi $tieuChiModel, BaoCaoSaoLuu $baoCaoSLModel, NhomNguoiDung $nhomNguoiDungModel, NguoiDungQuyen $nguoiDungQuyenModel, NhomQuyen $nhomQuyenModel, Nhom $nhomModel)
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
        $this->userModel = $userModel;
    }

    public function index()
    {
        $vaiTroHTs = auth()->user()->vaiTroHT;
        $nganhIds = [];
        foreach ($vaiTroHTs as $vaiTroHT) {
            foreach ($vaiTroHT->quyenHT as $quyenHT) {
                if (!empty($quyenHT->pivot->nganh_id)) {
                    $nganhIds[] = $quyenHT->pivot->nganh_id;
                }
            }
        }
        $nganhs = [];
        foreach ($nganhIds as $nganhId) {
            $nganh = DotDanhGia::orderBy('namHoc')
                        ->join('nganh_dot_danh_gias', 'nganh_dot_danh_gias.dotDanhGia_id', '=', 'dot_danh_gias.id')
                        ->join('nganhs', 'nganhs.id', '=', 'nganh_dot_danh_gias.nganh_id')
                        ->where('dot_danh_gias.trangThai', 0)
                        ->where('nganh_dot_danh_gias.nganh_id', $nganhId)->first();
            $nganhs[] = $nganh;
        }
        $tieuChuans = $this->tieuChuanModel->all();
        return view('pages.tiendobaocao.index', compact('nganhs', 'tieuChuans'));
    }
}
