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

class BaoCaoController extends Controller
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
            array_push($baoCaoIds, $nguoiDungQuyen->baoCao_id);
        }
        $baoCaos = $this->baoCaoModel->whereIn('id', $baoCaoIds)->orWhere('nguoiDung_id', $user->id)->get();
        $trashCount = count($this->baoCaoModel->onlyTrashed()->get());
        return view('pages.baocao.index', compact('baoCaos', 'trashCount'));
    }

    public function create()
    {
        $nhomIds = [];
        $nganhIds = [];
        $nhomNguoiDungs = $this->nhomNguoiDungModel->where('nguoiDung_id', auth()->user()->id)->get();
        foreach ($nhomNguoiDungs as $nhomNguoiDung) {
            if ($nhomNguoiDung->vaiTro_id === 2 || $nhomNguoiDung->vaiTro_id === 3) {
                $nhomQuyens = $this->nhomQuyenModel->where('nhom_id', $nhomNguoiDung->nhom_id)->where('quyenNhom_id', 1)->get();
                foreach ($nhomQuyens as $nhomQuyen) {
                    if (!in_array($nhomQuyen->nhom_id, $nhomIds, true)) {
                        array_push($nhomIds, $nhomQuyen->nhom_id);
                    }
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
        $nhomNguoiDungs = $this->nhomNguoiDungModel->where('nguoiDung_id', auth()->user()->id)->where('nganh_id', $nganhs[0]->id)->whereIn('vaiTro_id', [2, 3])->get();
        $tieuChuanIds = [];
        if ($nhomNguoiDungs) {
            foreach ($nhomNguoiDungs as $nhomNguoiDung) {
                $nhomQuyens = $this->nhomQuyenModel->where('nhom_id', $nhomNguoiDung->nhom_id)->get();
                foreach ($nhomQuyens as $nhomQuyen) {
                    array_push($tieuChuanIds, $nhomQuyen->tieuChuan_id);
                }
            }
        }

        $tieuChuans = $this->tieuChuanModel->whereIn('id', $tieuChuanIds)->get();
        if (!empty($tieuChuans[0])) {
            $tieuChis = $this->tieuChiModel->where('tieuChuan_id', $tieuChuans[0]->id)->get();
        } else {
            $tieuChis = [];
        }
        return view('pages.baocao.create', compact('nganhs', 'tieuChuans', 'tieuChis'));
    }

    public function store(Request $request)
    {
        $nganh = $this->nganhModel->find($request->nganh_id);
        $dotDanhGia = $nganh->dotDanhGia->sortBy('namHoc')->where('trangThai', 0)->first();
        $this->baoCaoModel->create([
            'moTa' => $request->moTa,
            'diemManh' => $request->diemManh,
            'diemTonTai' => $request->diemTonTai,
            'keHoachHanhDong' => $request->keHoachHanhDong,
            'diemTDG' => $request->diemTDG,
            'trangThai' => $request->trangThai,
            'nganh_id' => $request->nganh_id,
            'tieuChi_id' => $request->tieuChi_id,
            'dotDanhGia_id' => $dotDanhGia->id,
            'nguoiDung_id' => auth()->user()->id
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
        $baoCao = $this->baoCaoModel->find($id);
        $baoCao->update([
            'moTa' => $request->moTa,
            'diemManh' => $request->diemManh,
            'diemTonTai' => $request->diemTonTai,
            'keHoachHanhDong' => $request->keHoachHanhDong,
            'diemTDG' => $request->diemTDG,
            'trangThai' => $request->trangThai,
        ]);
        $baoCao->updated_at = Carbon::now();
        $baoCao->save(['timestamps' => FALSE]);
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

    public function finish(Request $request)
    {
        try {
            $this->baoCaoModel->find($request->id)->update([
                'trangThai' => 1
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

    public function reopen(Request $request)
    {
        try {
            $this->baoCaoModel->find($request->id)->update([
                'trangThai' => 0
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
        $nhomNguoiDungs = $this->nhomNguoiDungModel->where('nganh_id', $request->nganhId)->where('nguoiDung_id', auth()->user()->id)->whereIn('vaiTro_id', [2, 3])->get();
        $tieuChuanIds = [];
        if ($nhomNguoiDungs) {
            foreach ($nhomNguoiDungs as $nhomNguoiDung) {
                $nhomQuyens = $this->nhomQuyenModel->where('nhom_id', $nhomNguoiDung->nhom_id)->get();
                foreach ($nhomQuyens as $nhomQuyen) {
                    array_push($tieuChuanIds, $nhomQuyen->tieuChuan_id);
                }
            }
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
