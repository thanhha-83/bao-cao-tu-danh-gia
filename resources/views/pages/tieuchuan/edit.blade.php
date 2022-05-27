@extends('layouts.index', ['title' => 'Chỉnh sửa tiêu chuẩn'])

@php
$controller = (object) [
    'name' => 'Tiêu chuẩn',
    'href' => '/tieuchuan',
];
$action = (object) [
    'name' => 'Chỉnh sửa',
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
            <form action="{{ route('tieuchuan.update', ['id' => $tieuChuan->id]) }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="stt">Tiêu chuẩn số</label>
                        <input type="number" class="form-control {{ $errors->has('stt') ? 'is-invalid' : '' }}" id="stt"
                            name="stt" value="{{ old('stt', $tieuChuan->stt) }}">
                        @if ($errors->has('stt'))
                            <div class="invalid-feedback">
                                {{ $errors->first('stt') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-10">
                        <label for="ten">Tên tiêu chuẩn</label>
                        <input type="text" class="form-control {{ $errors->has('ten') ? 'is-invalid' : '' }}" id="ten"
                            name="ten" value="{{ old('ten', $tieuChuan->ten) }}">
                        @if ($errors->has('ten'))
                            <div class="invalid-feedback">
                                {{ $errors->first('ten') }}
                            </div>
                        @endif
                    </div>
                </div>
                {{-- <div class="form-group">
                    <label for="noiDung">Nội dung tiêu chuẩn</label>
                    <textarea class="form-control {{ $errors->has('noiDung') ? 'is-invalid' : '' }}" id="noiDung"
                        name="noiDung" rows="8">{{ old('noiDung', $tieuChuan->noiDung) }}</textarea>
                    @if ($errors->has('noiDung'))
                        <div class="invalid-feedback">
                            {{ $errors->first('noiDung') }}
                        </div>
                    @endif
                </div> --}}
                <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
        </div>
    </div>
@endsection
