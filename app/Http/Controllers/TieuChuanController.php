<?php

namespace App\Http\Controllers;

use App\Models\TieuChuan;
use Illuminate\Http\Request;

class TieuChuanController extends Controller
{
    private $tieuChuanModel;
    public function __construct(TieuChuan $tieuChuanModel)
    {
        $this->tieuChuanModel = $tieuChuanModel;
    }

    protected function callValidate(Request $request, $id = null)
    {
        if ($id) {
            $request->validate([
                'stt' => 'required|unique:tieu_chuans' . ',stt,' . $id,
                'ten' => 'required|unique:tieu_chuans' . ',ten,' . $id,
            ], [
                'stt.required' => 'Bạn chưa nhập số thứ tự tiêu chuẩn',
                'stt.unique' => 'Số thứ tự tiêu chuẩn đã tồn tại',
                'ten.required' => 'Bạn chưa nhập tên tiêu chuẩn',
                'ten.unique' => 'Tên tiêu chuẩn đã tồn tại',
            ]);
        } else {
            $request->validate([
                'stt' => 'required|unique:tieu_chuans',
                'ten' => 'required|unique:tieu_chuans',
            ], [
                'stt.required' => 'Bạn chưa nhập số thứ tự tiêu chuẩn',
                'stt.unique' => 'Số thứ tự tiêu chuẩn đã tồn tại',
                'ten.required' => 'Bạn chưa nhập tên tiêu chuẩn',
                'ten.unique' => 'Tên tiêu chuẩn đã tồn tại',
            ]);
        }

    }

    public function index()
    {
        $tieuChuans = $this->tieuChuanModel->all();
        $trashCount = count($this->tieuChuanModel->onlyTrashed()->get());
        return view('pages.tieuchuan.index', compact('tieuChuans', 'trashCount'));
    }

    public function create()
    {
        return view('pages.tieuchuan.create');
    }

    public function store(Request $request)
    {
        $this->callValidate($request);
        $this->tieuChuanModel->create([
            'stt' => $request->stt,
            'ten' => $request->ten,
        ]);
        return redirect()->route('tieuchuan.index')->with('message', 'Thêm thành công!');
    }

    public function edit($id)
    {
        $tieuChuan = $this->tieuChuanModel->find($id);
        return view('pages.tieuchuan.edit', compact('tieuChuan'));
    }

    public function update(Request $request, $id)
    {
        $this->callValidate($request, $id);
        $this->tieuChuanModel->find($id)->update([
            'stt' => $request->stt,
            'ten' => $request->ten,
        ]);
        return redirect()->route('tieuchuan.show', ['id' => $id])->with('message', 'Sửa thành công!');
    }

    public function destroy(Request $request)
    {
        try {
            $this->tieuChuanModel->find($request->id)->delete();
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
        $tieuChuans = $this->tieuChuanModel->onlyTrashed()->paginate(10);
        return view('pages.tieuchuan.trash', compact('tieuChuans'));
    }

    public function restore(Request $request)
    {
        try {
            $this->tieuChuanModel->onlyTrashed()->find($request->id)->restore();
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
            $this->tieuChuanModel->onlyTrashed()->restore();
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
            $this->tieuChuanModel->onlyTrashed()->find($request->id)->forceDelete();
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
            $this->tieuChuanModel->onlyTrashed()->forceDelete();
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
