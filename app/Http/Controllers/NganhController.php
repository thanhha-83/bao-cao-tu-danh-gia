<?php

namespace App\Http\Controllers;

use App\Models\Nganh;
use Illuminate\Http\Request;

class NganhController extends Controller
{
    private $nganhModel;
    public function __construct(Nganh $nganhModel)
    {
        $this->nganhModel = $nganhModel;
    }

    protected function callValidate(Request $request, $id = null)
    {
        $request->validate([
            'ten' => 'required|unique:nganhs' . ',ten,' . $id,
        ], [
            'ten.required' => 'Bạn chưa nhập tên ngành',
            'ten.unique' => 'Tên ngành đã tồn tại',
        ]);
    }

    public function index()
    {
        $nganhs = $this->nganhModel->all();
        $trashCount = count($this->nganhModel->onlyTrashed()->get());
        return view('pages.nganh.index', compact('nganhs', 'trashCount'));
    }

    public function create()
    {
        return view('pages.nganh.create');
    }

    public function store(Request $request)
    {
        $this->callValidate($request);
        $this->nganhModel->create([
            'ten' => $request->ten,
        ]);
        return redirect()->route('nganh.index')->with('message', 'Thêm thành công!');
    }

    public function edit($id)
    {
        $nganh = $this->nganhModel->find($id);
        return view('pages.nganh.edit', compact('nganh'));
    }

    public function update(Request $request, $id)
    {
        $this->callValidate($request, $id);
        $this->nganhModel->find($id)->update([
            'ten' => $request->ten,
        ]);
        return redirect()->route('nganh.index')->with('message', 'Sửa thành công!');
    }

    public function destroy(Request $request)
    {
        try {
            $this->nganhModel->find($request->id)->delete();
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
        $nganhs = $this->nganhModel->onlyTrashed()->paginate(10);
        return view('pages.nganh.trash', compact('nganhs'));
    }

    public function restore(Request $request)
    {
        try {
            $this->nganhModel->onlyTrashed()->find($request->id)->restore();
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
            $this->nganhModel->onlyTrashed()->restore();
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
            $this->nganhModel->onlyTrashed()->find($request->id)->forceDelete();
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
            $this->nganhModel->onlyTrashed()->forceDelete();
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
