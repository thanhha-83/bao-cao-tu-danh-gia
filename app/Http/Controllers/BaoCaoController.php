<?php

namespace App\Http\Controllers;

use App\Models\BaoCao;
use App\Models\BaoCaoSaoLuu;
use App\Models\Nganh;
use App\Models\Nhom;
use App\Models\NhomNguoiDung;
use App\Models\NhomQuyen;
use App\Models\TieuChi;
use App\Models\TieuChuan;
use Illuminate\Http\Request;

class BaoCaoController extends Controller
{
    private $baoCaoModel;
    private $nganhModel;
    private $tieuChuanModel;
    private $tieuChiModel;
    private $baoCaoSLModel;
    private $nhomNguoiDungModel;
    private $nhomQuyenModel;
    private $nhomModel;
    public function __construct(BaoCao $baoCaoModel, Nganh $nganhModel, TieuChuan $tieuChuanModel, TieuChi $tieuChiModel, BaoCaoSaoLuu $baoCaoSLModel, NhomNguoiDung $nhomNguoiDungModel, NhomQuyen $nhomQuyenModel, Nhom $nhomModel)
    {
        $this->baoCaoModel = $baoCaoModel;
        $this->nganhModel = $nganhModel;
        $this->tieuChuanModel = $tieuChuanModel;
        $this->tieuChiModel = $tieuChiModel;
        $this->baoCaoSLModel = $baoCaoSLModel;
        $this->nhomNguoiDungModel = $nhomNguoiDungModel;
        $this->nhomQuyenModel = $nhomQuyenModel;
        $this->nhomModel = $nhomModel;
    }

    public function index()
    {
        $baoCaos = $this->baoCaoModel->all();
        $trashCount = count($this->baoCaoModel->onlyTrashed()->get());
        return view('pages.baocao.index', compact('baoCaos', 'trashCount'));
    }

    public function create()
    {
        $nhomIds = [];
        $nganhIds = [];
        $nhomNguoiDungs = $this->nhomNguoiDungModel->where('nguoiDung_id', auth()->user()->id)->get();
        foreach ($nhomNguoiDungs as $nhomNguoiDung) {
            $nhomQuyens = $this->nhomQuyenModel->where('nhom_id', $nhomNguoiDung->nhom_id)->where('quyenNhom_id', 1)->get();
            foreach ($nhomQuyens as $nhomQuyen) {
                if (!in_array($nhomQuyen->nhom_id, $nhomIds, true)) {
                    array_push($nhomIds, $nhomQuyen->nhom_id);
                }
            }
        }
        $nhoms = $this->nhomModel->whereIn('id', $nhomIds)->get();
        foreach ($nhoms as $nhom) {
            if (!in_array($nhom->nganh_id, $nganhIds, true)) {
                array_push($nganhIds, $nhom->nganh_id);
            }
        }
        $nganhs = $this->nganhModel->whereIn('id', $nganhIds)->get();
        $nhomNguoiDung = $this->nhomNguoiDungModel->where('nguoiDung_id', auth()->user()->id)->first();
        $tieuChuanIds = [];
        $nhomQuyens = $this->nhomQuyenModel->where('nhom_id', $nhomNguoiDung->nhom_id)->get();
        foreach ($nhomQuyens as $nhomQuyen) {
            array_push($tieuChuanIds, $nhomQuyen->tieuChuan_id);
        }
        $tieuChuans = $this->tieuChuanModel->whereIn('id', $tieuChuanIds)->get();
        $tieuChis = $this->tieuChiModel->where('tieuChuan_id', $tieuChuans[0]->id)->get();
        return view('pages.baocao.create', compact('nganhs', 'tieuChuans', 'tieuChis'));
    }

    public function store(Request $request)
    {
        $this->baoCaoModel->create([
            'moTa' => $request->moTa,
            'diemManh' => $request->diemManh,
            'diemTonTai' => $request->diemTonTai,
            'keHoachHanhDong' => $request->keHoachHanhDong,
            'diemTDG' => $request->diemTDG,
            'trangThai' => $request->trangThai,
            'nganh_id' => $request->nganh_id,
            'tieuChi_id' => $request->tieuChi_id,
        ]);
        return redirect()->route('baocao.index')->with('message', 'Thêm thành công!');
    }

    public function show($id)
    {
        $baoCao = $this->baoCaoModel->find($id);
        return view('pages.baocao.show', compact('baoCao'));
    }

    public function edit($id)
    {
        $baoCao = $this->baoCaoModel->find($id);
        $nganhs = $this->nganhModel->all();
        $tieuChis = $this->tieuChiModel->all();
        return view('pages.baocao.edit', compact('baoCao', 'nganhs', 'tieuChis'));
    }

    public function update(Request $request, $id)
    {
        $this->baoCaoModel->find($id)->update([
            'moTa' => $request->moTa,
            'diemManh' => $request->diemManh,
            'diemTonTai' => $request->diemTonTai,
            'keHoachHanhDong' => $request->keHoachHanhDong,
            'diemTDG' => $request->diemTDG,
            'trangThai' => $request->trangThai
        ]);
        return redirect()->route('baocao.show', ['id' => $id])->with('message', 'Sửa thành công!');
    }

    public function destroy(Request $request)
    {
        try {
            $this->baoCaoModel->find($request->id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'fail',
            ], 500);
        }
    }

    public function trash()
    {
        $baoCaos = $this->baoCaoModel->onlyTrashed()->paginate(10);
        return view('pages.baocao.trash', compact('baoCaos'));
    }

    public function restore(Request $request)
    {
        try {
            $this->baoCaoModel->onlyTrashed()->find($request->id)->restore();
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'fail',
            ], 500);
        }
    }

    public function restoreAll(Request $request)
    {
        try {
            $this->baoCaoModel->onlyTrashed()->restore();
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'fail',
            ], 500);
        }
    }

    public function forceDestroy(Request $request)
    {
        try {
            $this->baoCaoModel->onlyTrashed()->find($request->id)->forceDelete();
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'fail',
            ], 500);
        }
    }

    public function forceDestroyAll(Request $request)
    {
        try {
            $this->baoCaoModel->onlyTrashed()->forceDelete();
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'fail',
            ], 500);
        }
    }

    public function word($id)
    {
        $baoCao = $this->baoCaoModel->find($id);
        return view('pages.baocao.word', compact('baoCao'));
    }

    public function backup(Request $request)
    {
        try {
            $baoCao = $this->baoCaoModel->find($request->id);
            $this->baoCaoSLModel->create([
                'moTa' => $baoCao->moTa,
                'diemManh' => $baoCao->diemManh,
                'diemTonTai' => $baoCao->diemTonTai,
                'keHoachHanhDong' => $baoCao->keHoachHanhDong,
                'diemTDG' => $baoCao->diemTDG,
                'nganh_id' => $baoCao->nganh_id,
                'tieuChi_id' => $baoCao->tieuChi_id,
                'baoCao_id' => $baoCao->id,
            ]);
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'fail',
            ], 500);
        }
    }

    public function handleSelectNganh(Request $request) {
        $nhomNguoiDung = $this->nhomNguoiDungModel->join('nhoms', 'nhoms.id', '=', 'nhom_nguoi_dungs.nhom_id')->where('nhoms.nganh_id', $request->nganhId)->where('nguoiDung_id', auth()->user()->id)->first();
        $tieuChuanIds = [];
        $nhomQuyens = $this->nhomQuyenModel->where('nhom_id', $nhomNguoiDung->nhom_id)->get();
        foreach ($nhomQuyens as $nhomQuyen) {
            array_push($tieuChuanIds, $nhomQuyen->tieuChuan_id);
        }
        $tieuChuans = $this->tieuChuanModel->whereIn('id', $tieuChuanIds)->get();
        $tieuChis = $this->tieuChiModel->with('tieuChuan')->where('tieuChuan_id', $tieuChuans[0]->id)->get();
        return response()->json([
            'tieuChuans' => $tieuChuans,
            'tieuChis' => $tieuChis
        ], 200);
    }

    public function handleSelectTieuChuan(Request $request) {
        $tieuChis = $this->tieuChiModel->with('tieuChuan')->where('tieuChuan_id', $request->tieuChuanId)->get();
        return response()->json([
            'tieuChis' => $tieuChis
        ], 200);
    }
}
