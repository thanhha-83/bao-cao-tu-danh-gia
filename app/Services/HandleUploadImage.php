<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HandleUploadImage {

    public static function upload($request, $fieldName, $dir) {
        if($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $fileName = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filePath = $request->file($fieldName)->storeAs('public/'.$dir.'/'.Auth::id(), $fileNameHash);
            return Storage::url($filePath);
        }
        return null;
    }
}
