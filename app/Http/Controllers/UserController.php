<?php

namespace App\Http\Controllers;

use App\Models\DonVi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\HandleUploadImage;

class UserController extends Controller
{
    private $userModel;
    private $donViModel;
    public function __construct(User $userModel, DonVi $donViModel)
    {
        $this->userModel = $userModel;
        $this->donViModel = $donViModel;
    }

    protected function callValidate(Request $request)
    {
        $request->validate([
            'hoTen' => 'required',
            'ngaySinh' => 'required',
            'chucVu' => 'required',
            'email' => 'required|email|unique:users' . ',email,' . $id,
            'sdt' => 'required|min:10|numeric|unique:users' . ',sdt,' . $id,
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'donVi_id' => 'numeric|min:1',
        ], [
            'hoTen.required' => 'Bạn chưa nhập họ tên',
            'ngaySinh.required' => 'Bạn chưa nhập ngày sinh',
            'chucVu.required' => 'Bạn chưa nhập chức vụ',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Bạn chưa nhập đúng định dạng email',
            'email.unique' => 'Email đã tồn tại',
            'sdt.required' => 'Bạn chưa nhập số điện thoại',
            'sdt.min' => 'Bạn chưa nhập đúng định dạng số điện thoại',
            'sdt.numeric' => 'Bạn chưa nhập đúng định dạng số điện thoại',
            'sdt.unique' => 'Số điện thoại đã tồn tại',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 kí tự',
            'password_confirmation.required' => 'Bạn chưa nhập lại mật khẩu',
            'password_confirmation.same' => 'Mật khẩu nhập lại không khớp',
            'donVi_id.numeric' => 'Bạn chưa chọn đơn vị',
            'donVi_id.min' => 'Bạn chưa chọn đơn vị',
        ]);
    }

    protected function callValidateEdit(Request $request, $id = null)
    {
        $request->validate([
            'hoTen' => 'required',
            'ngaySinh' => 'required',
            'chucVu' => 'required',
            'sdt' => 'required|min:10|numeric|unique:users' . ',sdt,' . $id,
            'donVi_id' => 'numeric|min:1',
        ], [
            'hoTen.required' => 'Bạn chưa nhập họ tên',
            'ngaySinh.required' => 'Bạn chưa nhập ngày sinh',
            'chucVu.required' => 'Bạn chưa nhập chức vụ',
            'sdt.required' => 'Bạn chưa nhập số điện thoại',
            'sdt.min' => 'Bạn chưa nhập đúng định dạng số điện thoại',
            'sdt.numeric' => 'Bạn chưa nhập đúng định dạng số điện thoại',
            'sdt.unique' => 'Số điện thoại đã tồn tại',
            'donVi_id.numeric' => 'Bạn chưa chọn đơn vị',
            'donVi_id.min' => 'Bạn chưa chọn đơn vị',
        ]);
    }

    public function index()
    {
        $users = $this->userModel->all();
        $trashCount = count($this->userModel->onlyTrashed()->get());
        return view('pages.user.index', compact('users', 'trashCount'));
    }

    public function create()
    {
        $donVis = $this->donViModel->all();
        return view('pages.user.create', compact('donVis'));
    }

    public function store(Request $request)
    {
        $this->callValidate($request);
        $fileUploaded = HandleUploadImage::upload($request, 'hinhAnh', 'photos');
        $this->userModel->create([
            'hoTen' => $request->hoTen,
            'gioiTinh' => $request->gioiTinh,
            'ngaySinh' => $request->ngaySinh,
            'chucVu' => $request->chucVu,
            'email' => $request->email,
            'sdt' => $request->sdt,
            'password' => Hash::make($request->password),
            'donVi_id' => $request->donVi_id,
            'hinhAnh'  => $fileUploaded
        ]);
        return redirect()->route('nguoidung.index')->with('message', 'Thêm thành công!');
    }

    public function show($id)
    {
        $user = $this->userModel->find($id);
        return view('pages.user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
        $donVis = $this->donViModel->all();
        return view('pages.user.edit', compact('user', 'donVis'));
    }

    public function update(Request $request, $id)
    {
        $this->callValidateEdit($request, $id);
        $this->userModel->find($id)->update([
            'hoTen' => $request->hoTen,
            'gioiTinh' => $request->gioiTinh,
            'ngaySinh' => $request->ngaySinh,
            'chucVu' => $request->chucVu,
            'sdt' => $request->sdt,
            'donVi_id' => $request->donVi_id,
        ]);
        return redirect()->route('nguoidung.show', ['id' => $id])->with('message', 'Sửa thành công!');
    }

    public function destroy(Request $request)
    {
        try {
            $this->userModel->find($request->id)->delete();
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
        $users = $this->userModel->onlyTrashed()->paginate(10);
        return view('pages.user.trash', compact('users'));
    }

    public function restore(Request $request)
    {
        try {
            $this->userModel->onlyTrashed()->find($request->id)->restore();
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
            $this->userModel->onlyTrashed()->restore();
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
            $this->userModel->onlyTrashed()->find($request->id)->forceDelete();
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
            $this->userModel->onlyTrashed()->forceDelete();
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
