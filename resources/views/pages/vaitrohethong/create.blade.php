@extends('layouts.index', ['title' => 'Thêm mới vai trò hệ thống'])

@php
$controller = (object) [
    'name' => 'Vai trò hệ thống',
    'href' => '/vaitrohethong',
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
            <form action="{{ route('vaitrohethong.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="ten">Tên vai trò hệ thống</label>
                    <input type="text" class="form-control {{ $errors->has('ten') ? 'is-invalid' : '' }}" id="ten"
                        name="ten" value="{{ old('ten', '') }}">
                    @if ($errors->has('ten'))
                        <div class="invalid-feedback">
                            {{ $errors->first('ten') }}
                        </div>
                    @endif
                </div>
                <p>Phân quyền</p>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 px-0">
                            <label>
                                <input type="checkbox" class="checkall">
                                Chọn tất cả
                            </label>
                        </div>
                        @foreach($parentQuyenHTs as $item)
                            <div class="card border-primary mb-3 col-md-12 p-0">
                                <div class="card-header">
                                    <label>
                                        <input type="checkbox" value="" class="checkbox_wrapper">
                                        {{ $item->ten }}
                                    </label>
                                </div>
                                <div class="row px-3">
                                    @foreach($item->childQuyenHT as $childItem)
                                        <div class="card-body text-primary col-md-4 py-2 px-3">
                                            <p class="card-title mb-0">
                                                <label>
                                                    <input type="checkbox" name="quyenHT[]"
                                                        class="checkbox_childrent"
                                                        value="{{ $childItem->id }}">
                                                    {{ $childItem->ten }}
                                                </label>
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('.checkbox_wrapper').on('click', function () {
                $(this).parents('.card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
            });

            $('.checkall').on('click', function () {
                $(this).parents().find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
                $(this).parents().find('.checkbox_wrapper').prop('checked', $(this).prop('checked'));
            });
        });
    </script>
@endsection