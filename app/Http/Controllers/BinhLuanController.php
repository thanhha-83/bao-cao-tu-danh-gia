<?php

namespace App\Http\Controllers;

use App\Events\MessageReplySent;
use App\Events\MessageSent;
use App\Models\BinhLuan;
use App\Models\User;
use Illuminate\Http\Request;

class BinhLuanController extends Controller
{
    private $binhLuanModel;
    private $nguoiDungModel;
    public function __construct(BinhLuan $binhLuanModel, User $nguoiDungModel)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->binhLuanModel = $binhLuanModel;
        $this->nguoiDungModel = $nguoiDungModel;
    }

    public function show(Request $request)
    {
        $binhLuans = $this->binhLuanModel->with('childBinhLuan')->with('nguoiDung')->where(['baoCao_id' => $request->id])->where(['parent_id' => 0])->get();
        if($binhLuans) {
            return response()->json($binhLuans, 200);
        } else {
            return response()->json(["message" => "Record not found"], 404);
        }
    }

    public function store(Request $request)
    {
        $binhLuan = $this->binhLuanModel->create([
            'noiDung' => $request->message,
            'nguoiDung_id' => auth()->user()->id,
            'baoCao_id' => $request->baoCao_id
        ]);
        $binhLuan->nguoi_dung = $binhLuan->nguoiDung;
        $binhLuan->child_binh_luan = $binhLuan->childBinhLuan;
        broadcast(new MessageSent($binhLuan, $request->baoCao_id));
        return response()->json($binhLuan, 200);
    }

    public function storeReply(Request $request)
    {
        $binhLuan = $this->binhLuanModel->create([
            'noiDung' => $request->message,
            'nguoiDung_id' => auth()->user()->id,
            'baoCao_id' => $request->baoCao_id,
            'parent_id' => $request->parent_id,
        ]);
        $binhLuan->nguoi_dung = $binhLuan->nguoiDung;
        broadcast(new MessageSent($binhLuan, $request->baoCao_id, 'isReply'));
        return response()->json($binhLuan, 200);
    }

    public function updateMessage(Request $request)
    {
        $binhLuan = $this->binhLuanModel->find($request->binhLuan_id);
        $binhLuan->update([
            'noiDung' => $request->message,
        ]);
        $binhLuan->nguoi_dung = $binhLuan->nguoiDung;
        broadcast(new MessageSent($binhLuan, $request->baoCao_id, 'isUpdate'));
        return response()->json($binhLuan, 200);
    }

    public function deleteMessage(Request $request)
    {
        $binhLuan = $this->binhLuanModel->find($request->binhLuan_id);
        $this->binhLuanModel->where('parent_id', $binhLuan->id)->forceDelete();
        broadcast(new MessageSent($binhLuan, $request->baoCao_id, 'isDelete'));
        $binhLuan->forceDelete();
        return response()->json('success',200);
    }
}
