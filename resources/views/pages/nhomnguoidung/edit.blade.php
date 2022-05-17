@extends('layouts.index', ['title' => 'Chỉnh sửa nhóm người dùng'])

@php
$controller = (object) [
    'name' => 'Nhóm người dùng',
    'href' => '/nhomnguoidung',
];
$action = (object) [
    'name' => 'Chỉnh sửa',
];
@endphp

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .btn-add,
        .btn-remove {
            padding: 0.6rem .75rem;
        }

    </style>
@endsection

@section('breadcrumb')
    @include('partials.breadcrumb', compact('controller', 'action'))
@endsection

@section('page-heading')
    @include('partials.page-heading', compact('controller', 'action'))
@endsection

@section('content')
    <div class="card shadow mb-4 w-75">
        <div class="card-body">
            <form action="{{ route('nhomnguoidung.update', ['id' => $nhomNguoiDung->id]) }}" method="POST">
                @csrf
                <div class="form-row pl-1">
                    <div class="form-group col-md-5">
                        <label for="vaiTro_id">Vai trò</label>
                        <select class="form-select form-control {{ $errors->has('vaiTro_id') ? 'is-invalid' : '' }}"
                            id="vaiTro_id" name="vaiTro_id" aria-label="Chọn Vai trò">
                            @foreach ($vaiTros as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('vaiTro_id', $nhomNguoiDung->vaiTro_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->ten }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('vaiTro_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nganh_id') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-row pl-1 wrap-select">
                    <div class="form-row pl-1 w-100">
                        <div class="form-group col-md-5">
                            <label>Quyền</label>
                            <select class="form-select form-control" id="select-1" aria-label="Chọn quyền">
                                <option value="" selected>Chọn quyền</option>
                                @foreach ($quyenNguoiDungs as $item)
                                    <option value="{{ $item->id }}">{{ $item->ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="ml-3 form-group col-md-5">
                            <label>Báo cáo</label>
                            <select class="form-select form-control" id="select-2" aria-label="Chọn quyền">
                                <option value="" selected>Chọn báo cáo</option>
                                @foreach ($baoCaos as $item)
                                    <option value="{{ $item->id }}">Báo cáo số {{$item->tieuChi->tieuChuan->stt}}.{{$item->tieuChi->stt}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="ml-3 mb-0 form-group col-md-1">
                            <label>&nbsp;</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text btn-primary btn-add" role="button"><i
                                        class="fa fa-plus"></i></span>
                            </div>
                        </div>
                    </div>
                    {{-- @php
                        $quyenNhom_id = old('quyenNhom_id', $current_quyenNhoms) != '' ? old('quyenNhom_id', $current_quyenNhoms) : [];
                        $tieuChuan_id = old('tieuChuan_id', $current_tieuChuans) != '' ? old('tieuChuan_id', $current_tieuChuans) : [];
                    @endphp
                    @if (!empty($quyenNhom_id) && !empty($tieuChuan_id))
                        @foreach ($quyenNhom_id as $key => $item)
                            @foreach ($quyenNhoms as $quyenNhom)
                                @if ($quyenNhom->id == $item)
                                    @php $text1 = $quyenNhom->ten @endphp
                                @endif
                            @endforeach
                            @foreach ($tieuChuans as $tieuChuan)
                                @if ($tieuChuan->id == $tieuChuan_id[$key])
                                    @php $text2 = 'Tiêu chuẩn số ' . $tieuChuan->stt @endphp
                                @endif
                            @endforeach
                            <div class="form-row pl-1 w-100 wrap-selected">
                                <div class="form-group col-md-5">
                                    <input type="text" class="form-control" value="{{ $text1 }}" readonly>
                                    <input type="hidden" class="value-1" name="quyenNhom_id[]"
                                        value="{{ $item }}">
                                </div>
                                <div class="ml-3 form-group col-md-5">
                                    <input type="text" class="form-control" value="{{ $text2 }}" readonly>
                                    <input type="hidden" class="value-2" name="tieuChuan_id[]"
                                        value="{{ $tieuChuan_id[$key] }}">
                                </div>
                                <div class="ml-3 mb-0 form-group col-md-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text btn-primary btn-remove" role="button"><i
                                                class="fa fa-minus"></i></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif --}}
                </div>
                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="js/handleMultipleSelect.js"></script>
    <script src="js/handleTwoSelect.js"></script>
@endsection
