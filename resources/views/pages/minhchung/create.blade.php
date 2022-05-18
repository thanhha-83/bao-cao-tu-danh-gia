@extends('layouts.index', ['title' => 'Thêm mới minh chứng'])

@php
$controller = (object) [
    'name' => 'Minh chứng',
    'href' => '/minhchung',
];
$action = (object) [
    'name' => 'Thêm mới',
];
@endphp

@section('breadcrumb')
    @include('partials.breadcrumb', compact('controller', 'action'))
@endsection

@section('page-heading')
    @include('partials.page-heading', compact('controller', 'action'))
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('minhchung.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="ten">Tên minh chứng</label>
                    <input type="text" class="form-control {{ $errors->has('ten') ? 'is-invalid' : '' }}" id="ten"
                        name="ten" value="{{ old('ten', '') }}">
                    @if ($errors->has('ten'))
                        <div class="invalid-feedback">
                            {{ $errors->first('ten') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="ngayKhaoSat">Ngày khảo sát</label>
                    <input type="date" class="form-control {{ $errors->has('ngayKhaoSat') ? 'is-invalid' : '' }}" id="ngayKhaoSat"
                        name="ngayKhaoSat" value="{{ old('ngayKhaoSat', '') }}">
                    @if ($errors->has('ngayKhaoSat'))
                        <div class="invalid-feedback">
                            {{ $errors->first('ngayKhaoSat') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="ngayBanHanh">Ngày ban hành</label>
                    <input type="date" class="form-control {{ $errors->has('ngayBanHanh') ? 'is-invalid' : '' }}" id="ngayBanHanh"
                        name="ngayBanHanh" value="{{ old('ngayBanHanh', '') }}">
                    @if ($errors->has('ngayBanHanh'))
                        <div class="invalid-feedback">
                            {{ $errors->first('ngayBanHanh') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="noiBanHanh">Nơi ban hành</label>
                    <input type="text" class="form-control {{ $errors->has('noiBanHanh') ? 'is-invalid' : '' }}" id="noiBanHanh"
                        name="noiBanHanh" value="{{ old('noiBanHanh', '') }}">
                    @if ($errors->has('noiBanHanh'))
                        <div class="invalid-feedback">
                            {{ $errors->first('noiBanHanh') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="donVi_id">Đơn vị</label>
                    <select class="form-select form-control {{ $errors->has('donVi_id') ? 'is-invalid' : '' }}"
                        id="donVi_id" name="donVi_id" aria-label="Chọn đơn vị">
                        <option {{ old('donVi_id', '') == '' ? 'selected' : '' }}>Chọn đơn vị</option>
                        @foreach ($donVis as $item)
                            <option value="{{ $item->id }}" {{ old('donVi_id', '') == $item->id ? 'selected' : '' }}>{{ $item->ten }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('donVi_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('donVi_id') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="fileMinhChung">Tệp minh chứng</label>
                    <input type="file" class="form-control {{ $errors->has('fileMinhChung') ? 'is-invalid' : '' }}" id="fileMinhChung"
                        name="fileMinhChung" value="{{ old('fileMinhChung', '') }}">
                    @if ($errors->has('fileMinhChung'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fileMinhChung') }}
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </form>
        </div>
    </div>
@endsection
