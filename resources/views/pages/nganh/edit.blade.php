@extends('layouts.index', ['title' => 'Chỉnh sửa ngành'])

@php
$controller = (object) [
    'name' => 'Ngành',
    'href' => '/nganh',
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
            <form action="{{ route('nganh.update', ['id' => $nganh->id]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="ten">Tên ngành</label>
                    <input type="text" class="form-control {{ $errors->has('ten') ? 'is-invalid' : '' }}" id="ten"
                        name="ten" value="{{ old('ten', $nganh->ten) }}">
                    @if ($errors->has('ten'))
                        <div class="invalid-feedback">
                            {{ $errors->first('ten') }}
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
        </div>
    </div>
@endsection
