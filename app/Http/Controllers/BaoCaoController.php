<?php

namespace App\Http\Controllers;

use App\Models\BaoCao;
use Illuminate\Http\Request;

class BaoCaoController extends Controller
{
    private $baoCaoModel;
    public function __construct(BaoCao $baoCaoModel)
    {
        $this->baoCaoModel = $baoCaoModel;
    }

    public function index()
    {
        $baoCaos = $this->baoCaoModel->all();
        $trashCount = count($this->baoCaoModel->onlyTrashed()->get());
        return view('pages.baocao.index', compact('baoCaos', 'trashCount'));
    }

    public function create()
    {
        return view('pages.baocao.create');
    }

    public function store(Request $request)
    {
        $this->baoCaoModel->create([
            'moTa' => $request->moTa,
            'diemManh' => $request->diemManh,
            'diemTonTai' => $request->diemTonTai,
            'keHoachHanhDong' => $request->keHoachHanhDong,
            'diem' => $request->diem,
            'trangThai' => $request->trangThai
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
        return view('pages.baocao.edit', compact('baoCao'));
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
}
