<?php

namespace App\Services;

class HandleUpdate3Many {

    public static function handleUpdateNhomQuyen($nhomQuyens, $quyenTieuChuans, $nhomQuyenModel, $nhom_id)
    {
        if (count($nhomQuyens) > count($quyenTieuChuans)) {
            foreach ($quyenTieuChuans as $key => $item) {
                $nhomQuyens[$key]->update([
                    'quyenNhom_id' => $item->quyenNhom_id,
                    'tieuChuan_id' => $item->tieuChuan_id,
                ]);
            }
            foreach ($nhomQuyens as $key => $nhomQuyen) {
                if ($key >= count($quyenTieuChuans)) {
                    $nhomQuyen->forceDelete();
                }
            }
        } else {
            foreach ($nhomQuyens as $key => $nhomQuyen) {
                $nhomQuyen->update([
                    'quyenNhom_id' => $quyenTieuChuans[$key]->quyenNhom_id,
                    'tieuChuan_id' => $quyenTieuChuans[$key]->tieuChuan_id,
                ]);
            }
            foreach ($quyenTieuChuans as $key => $item) {
                if ($key >= count($nhomQuyens)) {
                    $nhomQuyenModel->create([
                        'nhom_id' => $nhom_id,
                        'quyenNhom_id' => $item->quyenNhom_id,
                        'tieuChuan_id' => $item->tieuChuan_id,
                    ]);
                }
            }
        }
        return;
    }
}
