<?php

namespace App\Http\Controllers;

use App\Models\MinhChung;
use App\Models\DonVi;
use Illuminate\Http\Request;
use App\Services\HandleUploadImage;

class MinhChungController extends Controller
{
    private $minhChungModel;
    private $donViModel;
    public function __construct(MinhChung $minhChungModel, DonVi $donViModel)
    {
        $this->minhChungModel = $minhChungModel;
        $this->donViModel = $donViModel;
    }

    protected function callValidate(Request $request, $id = null)
    {
        if ($request->isMCGop == 'on') {
            $request->validate([
                'ten' => 'required|unique:minh_chungs' . ',ten,' . $id,
            ], [
                'ten.required' => 'Bạn chưa nhập tên minh chứng',
                'ten.unique' => 'Tên minh chứng đã tồn tại',
            ]);
        } else {
            $request->validate([
                'ten' => 'required|unique:minh_chungs' . ',ten,' . $id,
                'fileMinhChung' => 'required',
            ], [
                'ten.required' => 'Bạn chưa nhập tên minh chứng',
                'ten.unique' => 'Tên minh chứng đã tồn tại',
                'fileMinhChung.required' => 'Bạn chưa chèn tệp minh chứng',
            ]);
        }
    }

    public function index()
    {
        $minhChungs = $this->minhChungModel->all();
        $trashCount = count($this->minhChungModel->onlyTrashed()->get());
        return view('pages.minhchung.index', compact('minhChungs', 'trashCount'));
    }

    public function create()
    {
        $donVis = $this->donViModel->all();
        return view('pages.minhchung.create', compact('donVis'));
    }

    public function store(Request $request)
    {
        $this->callValidate($request);
        $fileUploaded = HandleUploadImage::upload($request, 'fileMinhChung', 'minhchungs');
        $this->minhChungModel->create([
            'ten' => $request->ten,
            'ngayKhaoSat' => $request->ngayKhaoSat,
            'ngayBanHanh' => $request->ngayBanHanh,
            'noiBanHanh' => $request->noiBanHanh,
            'link' => $fileUploaded,
            'donVi_id' => $request->donVi_id,
            'isMCGop' => $request->isMCGop == 'on' ? 1 : 0,
        ]);
        return redirect()->route('minhchung.index')->with('message', 'Thêm thành công!');
    }

    public function edit($id)
    {
        $minhChung = $this->minhChungModel->find($id);
        return view('pages.minhchung.edit', compact('minhChung'));
    }

    public function update(Request $request, $id)
    {
        $this->callValidate($request, $id);
        $this->minhChungModel->find($id)->update([
            'ten' => $request->ten,
        ]);
        return redirect()->route('minhchung.index')->with('message', 'Sửa thành công!');
    }

    public function addDetail($id)
    {
        $minhChung = $this->minhChungModel->find($id);
        if ($minhChung->isMCGop) {
            return view('pages.minhchung.addDetail', compact('minhChung'));
        } else {
            return redirect()->route('minhchung.index')->with('message', 'Bạn đang cố gắng truy cập vào chức năng quản lý MCTP đối với minh chứng đơn!');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $this->minhChungModel->find($request->id)->delete();
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
        $minhChungs = $this->minhChungModel->onlyTrashed()->paginate(10);
        return view('pages.minhchung.trash', compact('minhChungs'));
    }

    public function restore(Request $request)
    {
        try {
            $this->minhChungModel->onlyTrashed()->find($request->id)->restore();
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
            $this->minhChungModel->onlyTrashed()->restore();
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
            $this->minhChungModel->onlyTrashed()->find($request->id)->forceDelete();
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
            $this->minhChungModel->onlyTrashed()->forceDelete();
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
    public function getAll() {
        return response()->json($this->minhChungModel->all(), 200);
    }
}
