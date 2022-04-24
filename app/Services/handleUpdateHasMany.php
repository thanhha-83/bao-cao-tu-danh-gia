<?php

namespace App\Services;

class HandleUpdateHasMany {

    public static function handleUpdateYeuCau($yeuCaus, $tieuChiId, $request, $yeuCauModel)
    {
        if (empty($request->yeuCau)) {
            foreach ($yeuCaus as $yeuCau) {
                $yeuCau->forceDelete();
            }
            return;
        }
        if (count($yeuCaus) >= count($request->yeuCau)) {
            foreach ($request->yeuCau as $key => $item) {
                $yeuCauModel->find($yeuCaus[$key]->id)->update([
                    'noiDung' => $item,
                    'tieuChi_id' => $tieuChiId
                ]);
            }
            foreach ($yeuCaus as $key => $yeuCau) {
                if ($key >= count($request->yeuCau)) {
                    $yeuCau->forceDelete();
                }
            }
        } else {
            foreach ($yeuCaus as $key => $yeuCau) {
                $yeuCauModel->find($yeuCau->id)->update([
                    'noiDung' => $request->yeuCau[$key],
                    'tieuChi_id' => $tieuChiId
                ]);
            }
            foreach ($request->yeuCau as $key => $item) {
                if ($key >= count($yeuCaus)) {
                    $yeuCauModel->create([
                        'noiDung' => $item,
                        'tieuChi_id' => $tieuChiId
                    ]);
                }
            }
        }
        return 0;
    }

    public static function handleUpdateMocChuan($mocChuans, $tieuChiId, $request, $mocChuanModel)
    {
        if (empty($request->mocChuan)) {
            foreach ($mocChuans as $mocChuan) {
                $mocChuan->forceDelete();
            }
            return;
        }
        if (count($mocChuans) >= count($request->mocChuan)) {
            foreach ($request->mocChuan as $key => $item) {
                $mocChuanModel->find($mocChuans[$key]->id)->update([
                    'noiDung' => $item,
                    'tieuChi_id' => $tieuChiId
                ]);
            }
            foreach ($mocChuans as $key => $mocChuan) {
                if ($key >= count($request->mocChuan)) {
                    $mocChuan->forceDelete();
                }
            }
        } else {
            foreach ($mocChuans as $key => $mocChuan) {
                $mocChuanModel->find($mocChuan->id)->update([
                    'noiDung' => $request->mocChuan[$key],
                    'tieuChi_id' => $tieuChiId
                ]);
            }
            foreach ($request->mocChuan as $key => $item) {
                if ($key >= count($mocChuans)) {
                    $mocChuanModel->create([
                        'noiDung' => $item,
                        'tieuChi_id' => $tieuChiId
                    ]);
                }
            }
        }
        return 0;
    }
}
