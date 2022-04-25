<?php

namespace App\Http\Controllers;

use App\Models\Nganh;
use App\Models\Nhom;
use App\Models\NhomQuyen;
use App\Models\QuyenNhom;
use App\Models\TieuChuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NhomController extends Controller
{
    private $nhomModel;
    private $nganhModel;
    private $quyenNhomModel;
    private $tieuChuanModel;
    private $nhomQuyenModel;
    public function __construct(Nhom $nhomModel, Nganh $nganhModel, QuyenNhom $quyenNhomModel, TieuChuan $tieuChuanModel, NhomQuyen $nhomQuyenModel)
    {
        $this->nhomModel = $nhomModel;
        $this->nganhModel = $nganhModel;
        $this->quyenNhomModel = $quyenNhomModel;
        $this->tieuChuanModel = $tieuChuanModel;
        $this->nhomQuyenModel = $nhomQuyenModel;
    }

    protected function callValidate(Request $request, $id = null)
    {
        $request->validate([
            'ten' => 'required',
            'nganh_id' => 'numeric|min:1'
        ], [
            'ten.required' => 'Bạn chưa nhập tên nhóm',
            'nganh_id.min' => 'Bạn chưa chọn ngành',
            'nganh_id.numeric' => 'Bạn chưa chọn ngành',
        ]);
    }

    public function index()
    {
        $nhoms = $this->nhomModel->all();
        $trashCount = count($this->nhomModel->onlyTrashed()->get());
        return view('pages.nhom.index', compact('nhoms', 'trashCount'));
    }

    public function create()
    {
        $quyenNhoms = $this->quyenNhomModel->all();
        $nganhs = $this->nganhModel->all();
        $tieuChuans = $this->tieuChuanModel->all();
        return view('pages.nhom.create', compact('quyenNhoms', 'nganhs', 'tieuChuans'));
    }

    public function store(Request $request)
    {
        $this->callValidate($request);
        try {
            DB::beginTransaction();
            $nhom = $this->nhomModel->create([
                'ten' => $request->ten,
                'nganh_id' => $request->nganh_id
            ]);

            if (!empty($request->quyenNhom_id) && !empty($request->tieuChuan_id)) {
                foreach ($request->quyenNhom_id as $key => $item) {
                    $nhom->nhomQuyen()->attach($item, [
                        'tieuChuan_id' => $request->tieuChuan_id[$key]
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('nhom.index')->with('message', 'Thêm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
        }
    }

    public function show($id)
    {
        $nhom = $this->nhomModel->find($id);
        $tieuChuans = $this->tieuChuanModel->all();
        return view('pages.nhom.show', compact('nhom', 'tieuChuans'));
    }

    public function edit($id)
    {
        $nhom = $this->nhomModel->find($id);
        $quyenNhoms = $this->quyenNhomModel->all();
        $nganhs = $this->nganhModel->all();
        $tieuChuans = $this->tieuChuanModel->all();
        $current_quyenNhoms = [];
        $current_tieuChuans = [];
        $nhomQuyens = $this->nhomQuyenModel->where('nhom_id', $id)->get();
        foreach ($nhomQuyens as $item) {
            array_push($current_quyenNhoms, $item->quyenNhom_id);
            array_push($current_tieuChuans, $item->tieuChuan_id);
        }
        return view('pages.nhom.edit', compact('nhom', 'quyenNhoms', 'nganhs', 'tieuChuans', 'current_quyenNhoms', 'current_tieuChuans'));
    }

    public function update(Request $request, $id)
    {
        $this->callValidate($request);
        try {
            DB::beginTransaction();
            $nhom = $this->nhomModel->find($id);
            $nhom->update([
                'ten' => $request->ten,
                'nganh_id' => $request->nganh_id
            ]);

            if (!empty($request->quyenNhom_id) && !empty($request->tieuChuan_id)) {
                foreach ($request->quyenNhom_id as $key => $item) {
                    $nhom->nhomQuyen()->sync($item, [
                        'tieuChuan_id' => $request->tieuChuan_id[$key]
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('nhom.show', ['id' => $id])->with('message', 'Sửa thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $this->nhomModel->find($request->id)->delete();
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
        $nhoms = $this->nhomModel->onlyTrashed()->paginate(10);
        return view('pages.nhom.trash', compact('nhoms'));
    }

    public function restore(Request $request)
    {
        try {
            $this->nhomModel->onlyTrashed()->find($request->id)->restore();
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
            $this->nhomModel->onlyTrashed()->restore();
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
            $nhom = $this->nhomModel->onlyTrashed()->find($request->id);
            $nhom->yeuCau()->forceDelete();
            $nhom->mocChuan()->forceDelete();
            $nhom->tuKhoa()->detach();
            $nhom->forceDelete();
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
            $nhoms = $this->nhomModel->onlyTrashed()->get();
            foreach ($nhoms as $nhom) {
                $nhom->yeuCau()->forceDelete();
                $nhom->mocChuan()->forceDelete();
                $nhom->tuKhoa()->detach();
            }
            $this->nhomModel->onlyTrashed()->forceDelete();
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
