<?php

namespace App\Http\Controllers;

use App\Models\BaoCao;
use App\Models\BaoCaoSaoLuu;
use App\Models\Nganh;
use App\Models\TieuChi;
use Illuminate\Http\Request;

class BaoCaoController extends Controller
{
    private $baoCaoModel;
    private $nganhModel;
    private $tieuChiModel;
    private $baoCaoSLModel;
    public function __construct(BaoCao $baoCaoModel, Nganh $nganhModel, TieuChi $tieuChiModel, BaoCaoSaoLuu $baoCaoSLModel)
    {
        $this->baoCaoModel = $baoCaoModel;
        $this->nganhModel = $nganhModel;
        $this->tieuChiModel = $tieuChiModel;
        $this->baoCaoSLModel = $baoCaoSLModel;
    }

    public function index()
    {
        $baoCaos = $this->baoCaoModel->all();
        $trashCount = count($this->baoCaoModel->onlyTrashed()->get());
        return view('pages.baocao.index', compact('baoCaos', 'trashCount'));
    }

    public function create()
    {
        $nganhs = $this->nganhModel->all();
        $tieuChis = $this->tieuChiModel->all();
        return view('pages.baocao.create', compact('nganhs', 'tieuChis'));
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
        return redirect()->route('tieuchuan.index')->with('message', 'Thêm thành công!');
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
            'diem' => $request->diem,
            'trangThai' => $request->trangThai
        ]);
        return redirect()->route('tieuchuan.show', ['id' => $id])->with('message', 'Sửa thành công!');
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
}
