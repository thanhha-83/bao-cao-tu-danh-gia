<?php

namespace App\Services;

use App\Models\BaoCao;
use App\Models\Nhom;
use App\Models\NhomNguoiDung;
use App\Models\NhomQuyen;
use App\Models\TieuChuan;

class BaoCaoPermission {
    private $tieuChuanModel;
    private $nhomNguoiDungModel;
    private $nhomQuyenModel;
    private $nhomModel;
    public function __construct()
    {
        $this->baoCaoModel = new BaoCao();
        $this->tieuChuanModel = new TieuChuan();
        $this->nhomNguoiDungModel = new NhomNguoiDung();
        $this->nhomQuyenModel = new NhomQuyen();
        $this->nhomModel = new Nhom();
    }

    public function create() {
        $nhomIds = [];
        $tieuChuanIds = [];
        $vaiTroIds = [];
        $nhomNguoiDungs = $this->nhomNguoiDungModel->where('nguoiDung_id', auth()->user()->id)->get();
        foreach ($nhomNguoiDungs as $nhomNguoiDung) {
            $nhomQuyens = $this->nhomQuyenModel->where('nhom_id', $nhomNguoiDung->nhom_id)->where('quyenNhom_id', 1)->get();
            foreach ($nhomQuyens as $nhomQuyen) {
                array_push($tieuChuanIds, $nhomQuyen->tieuChuan_id);
                if (!in_array($nhomQuyen->nhom_id, $nhomIds, true)) {
                    array_push($nhomIds, $nhomQuyen->nhom_id);
                }
            }
            if ($nhomNguoiDung->vaiTro_id === 2 || $nhomNguoiDung->vaiTro_id === 3) {
                array_push($vaiTroIds, $nhomNguoiDung->vaiTro_id);
            }
        }
        $tieuChuans = $this->tieuChuanModel->whereIn('id', $tieuChuanIds)->get();
        if (!empty($tieuChuans) && count($tieuChuans) > 0 && !empty($vaiTroIds) && count($vaiTroIds) > 0) {
            return true;
        } return false;
    }
}
