@extends('layouts.index', ['title' => 'Chỉnh sửa tiêu chí'])

@php
$controller = (object) [
    'name' => 'Tiêu chí',
    'href' => '/tieuchi',
];
$action = (object) [
    'name' => 'Chỉnh sửa',
];
@endphp

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('breadcrumb')
    @include('partials.breadcrumb', compact('controller', 'action'))
@endsection

@section('page-heading')
    @include('partials.page-heading', compact('controller', 'action'))
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('tieuchi.update', ['id' => $tieuChi->id]) }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="stt">Tiêu chí số</label>
                        <input type="number" class="form-control {{ $errors->has('stt') ? 'is-invalid' : '' }}" id="stt"
                            name="stt" value="{{ old('stt', $tieuChi->stt) }}">
                        @if ($errors->has('stt'))
                            <div class="invalid-feedback">
                                {{ $errors->first('stt') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-10">
                        <label for="ten">Tên tiêu chí</label>
                        <input type="text" class="form-control {{ $errors->has('ten') ? 'is-invalid' : '' }}" id="ten"
                            name="ten" value="{{ old('ten', $tieuChi->ten) }}">
                        @if ($errors->has('ten'))
                            <div class="invalid-feedback">
                                {{ $errors->first('ten') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="tieuChuan_id">Tiêu chuẩn</label>
                    <select class="form-select form-control {{ $errors->has('tieuChuan_id') ? 'is-invalid' : '' }}"
                        id="tieuChuan_id" name="tieuChuan_id" aria-label="Chọn tiêu chuẩn">
                        <option {{ old('tieuChuan_id', $tieuChi->tieuChuan_id) == '' ? 'selected' : '' }}>Chọn tiêu chuẩn</option>
                        @foreach ($tieuChuans as $item)
                            <option value="{{ $item->id }}" {{ old('tieuChuan_id', $tieuChi->tieuChuan_id) == $item->id ? 'selected' : '' }}>Tiêu chuẩn số {{ $item->stt }}: {{$item->ten}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('tieuChuan_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tieuChuan_id') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="yeuCau">Yêu cầu</label>
                    <div class="input-group">
                        <input type="text"
                            class="multiple-input form-control"
                            id="yeuCau" data-name="yeuCau[]">
                        <div class="input-group-prepend">
                            <span class="input-group-text btn-primary btn-add" role="button"><i
                                    class="fa fa-plus"></i></span>
                        </div>
                    </div>
                    @php
                        $yeuCaus = [];
                        foreach ($tieuChi->yeuCau as $item) {
                            $yeuCaus[] = $item->noiDung;
                        }
                        $yeuCau = old('yeuCau', $yeuCaus) != '' ? old('yeuCau', $yeuCaus) : []
                    @endphp
                    @foreach ($yeuCau as $item)
                        <div class="input-group mt-1">
                            <input type="text" class="form-control" name="yeuCau[]" value="{{ $item }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text btn-secondary btn-remove" role="button"><i class="fa fa-minus"></i></span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="mocChuan">Mốc chuẩn</label>
                    <div class="input-group">
                        <input type="text"
                            class="multiple-input form-control"
                            id="mocChuan" data-name="mocChuan[]">
                        <div class="input-group-prepend">
                            <span class="input-group-text btn-primary btn-add" role="button"><i
                                    class="fa fa-plus"></i></span>
                        </div>
                    </div>
                    @php
                        $mocChuans = [];
                        foreach ($tieuChi->mocChuan as $item) {
                            $mocChuans[] = $item->noiDung;
                        }
                        $mocChuan = old('mocChuan', $mocChuans) != '' ? old('mocChuan', $mocChuans) : [];
                    @endphp
                    @foreach ($mocChuan as $item)
                        <div class="input-group mt-1">
                            <input type="text" class="form-control" name="mocChuan[]" value="{{ $item }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text btn-secondary btn-remove" role="button"><i class="fa fa-minus"></i></span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="tuKhoa">Từ khóa</label>
                    <select class="form-control tags-select"
                        multiple="multiple" name="tuKhoa[]">
                        @php
                            $tuKhoas = [];
                            foreach ($tieuChi->tuKhoa as $item) {
                                $tuKhoas[] = $item->noiDung;
                            }
                            $tuKhoa = old('tuKhoa', $tuKhoas) != '' ? old('tuKhoa', $tuKhoas) : [];
                        @endphp
                        @foreach($tuKhoa as $item)
                            <option value="{{ $item }}" selected>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="js/handleMultipleInput.js"></script>
    <script src="js/handleMultipleSelect.js"></script>
@endsection
