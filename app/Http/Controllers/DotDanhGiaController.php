<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\DotDanhGia;
use App\Models\GiaiDoan;
use App\Models\Nganh;
use App\Models\HoatDong;
use App\Services\HandleUpdateHasMany;

class DotDanhGiaController extends Controller
{
    private $dotDanhGiaModel;
    private $nganhModel;
    private $giaiDoanModel;
    private $hoatDongModel;
    public function __construct(DotDanhGia $dotDanhGiaModel, Nganh $nganhModel, GiaiDoan $giaiDoanModel, HoatDong $hoatDongModel)
    {
        $this->dotDanhGiaModel = $dotDanhGiaModel;
        $this->nganhModel = $nganhModel;
        $this->giaiDoanModel = $giaiDoanModel;
        $this->hoatDongModel = $hoatDongModel;
    }

    protected function callValidate(Request $request, $id = null)
    {
        $request->validate([
            'ten' => 'required|unique:dot_danh_gias' . ',ten,' . $id,
        ], [
            'ten.required' => 'Bạn chưa nhập tên đợt đánh giá',
            'ten.unique' => 'Tên đợt đánh giá đã tồn tại',
        ]);
    }

    public function index()
    {
        $dotDanhGias = $this->dotDanhGiaModel->all();
        $trashCount = count($this->dotDanhGiaModel->onlyTrashed()->get());
        return view('pages.dotdanhgia.index', compact('dotDanhGias', 'trashCount'));
    }

    public function create()
    {
        $nganhs = $this->nganhModel->all();
        $hoatDongs = $this->hoatDongModel->all();
        $namHocs = [];
        for ($i = date('Y') - 20; $i < date('Y') + 20; $i++) {
            $namHocs[] = $i;
        }
        return view('pages.dotdanhgia.create', compact('nganhs', 'namHocs', 'hoatDongs'));
    }

    public function store(Request $request)
    {
        $this->callValidate($request);
        try {
            DB::beginTransaction();
            $dotDanhGia = $this->dotDanhGiaModel->create([
                'ten' => $request->ten,
                'namHoc' => $request->namHoc,
            ]);
            $nganhIds = !empty($request->nganh) ? $request->nganh : [];
            $dotDanhGia->nganh()->attach($nganhIds);
            if (!empty($request->hoatDong_id)) {
                foreach ($request->hoatDong_id as $key => $item) {
                    $this->giaiDoanModel->create([
                        'ngayBD' => $request->ngayBD[$key],
                        'ngayKT' => $request->ngayKT[$key],
                        'hoatDong_id' => $item,
                        'dotDanhGia_id' => $dotDanhGia->id
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('dotdanhgia.index')->with('message', 'Thêm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
        }
    }

    public function show($id)
    {
        $dotDanhGia = $this->dotDanhGiaModel->find($id);
        return view('pages.dotdanhgia.show', compact('dotDanhGia'));
    }

    public function edit($id)
    {
        $dotDanhGia = $this->dotDanhGiaModel->find($id);
        $nganhs = $this->nganhModel->all();
        $hoatDongs = $this->hoatDongModel->all();
        $namHocs = [];
        for ($i = date('Y') - 20; $i < date('Y') + 20; $i++) {
            $namHocs[] = $i;
        }
        $current_hoatDongs = [];
        $current_ngayBD = [];
        $current_ngayKT = [];
        foreach ($dotDanhGia->hoatDong as $item) {
            array_push($current_hoatDongs, $item->id);
            array_push($current_ngayBD, $item->pivot->ngayBD);
            array_push($current_ngayKT, $item->pivot->ngayKT);
        }
        return view('pages.dotdanhgia.edit', compact('dotDanhGia', 'nganhs', 'namHocs', 'hoatDongs', 'current_hoatDongs', 'current_ngayBD', 'current_ngayKT'));
    }

    public function update(Request $request, $id)
    {
        $this->callValidate($request, $id);
        try {
            DB::beginTransaction();
            $dotDanhGia = $this->dotDanhGiaModel->find($id);
            $dotDanhGia->update([
                'ten' => $request->ten,
                'namHoc' => $request->namHoc,
            ]);
            $nganhIds = !empty($request->nganh) ? $request->nganh : [];
            $dotDanhGia->nganh()->sync($nganhIds);
            $giaiDoans = $this->giaiDoanModel->where('dotDanhGia_id', $id)->get();
            HandleUpdateHasMany::handleUpdateGiaiDoan($giaiDoans, $id, $request, $this->giaiDoanModel);
            DB::commit();
            return redirect()->route('dotdanhgia.show', ['id' => $id])->with('message', 'Sửa thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $this->dotDanhGiaModel->find($request->id)->delete();
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
        $dotDanhGias = $this->dotDanhGiaModel->onlyTrashed()->paginate(10);
        return view('pages.dotdanhgia.trash', compact('dotDanhGias'));
    }

    public function restore(Request $request)
    {
        try {
            $this->dotDanhGiaModel->onlyTrashed()->find($request->id)->restore();
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
            $this->dotDanhGiaModel->onlyTrashed()->restore();
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
            $dotDanhGia = $this->dotDanhGiaModel->onlyTrashed()->find($request->id);
            $dotDanhGia->nganh()->detach();
            $dotDanhGia->giaiDoan()->forceDelete();
            $dotDanhGia->forceDelete();
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
            $dotDanhGias = $this->dotDanhGiaModel->onlyTrashed()->get();
            foreach ($dotDanhGias as $dotDanhGia) {
                $dotDanhGia->giaiDoan()->forceDelete();
                $dotDanhGia->tuKhoa()->detach();
            }
            $this->dotDanhGiaModel->onlyTrashed()->forceDelete();
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
