@extends('layouts.index', ['title' => 'Danh sách tiêu chuẩn'])

@php
$controller = (object) [
    'name' => 'Tiêu chuẩn',
    'href' => '/tieuchuan',
];
$action = (object) [
    'name' => 'Danh sách',
];
@endphp

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('breadcrumb')
    @include('partials.breadcrumb', compact('controller', 'action'))
@endsection

@section('page-heading')
    @include('partials.page-heading', compact('controller', 'action'))
@endsection

@section('message')
    @include('partials.message', [
        'message' => Session::has('message') ? Session::get('message') : null,
    ])
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            @can('tieuchuan-them')
            <a href="{{ route('tieuchuan.create') }}" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Thêm mới</span>
            </a>
            @endcan
            @can('tieuchuan-xoa')
            <a href="{{ route('tieuchuan.trash') }}" class="btn btn-dark btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text">Thùng rác
                    <span class="trash-count">{{ $trashCount > 0 ? '(' . $trashCount . ')' : '' }}</span>
                </span>
            </a>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên tiêu chuẩn</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($tieuChuans) > 0)
                            @foreach ($tieuChuans as $item)
                                <tr>
                                    <td>Tiêu chuẩn số {{ $item->stt }}</td>
                                    <td>{{ $item->ten }}</td>
                                    <td>
                                        {{-- <a href="{{ route('tieuchuan.show', ['id' => $item->id]) }}"
                                            class="btn btn-primary">Xem chi tiết</a> --}}
                                        @can('tieuchuan-sua')
                                        <a href="{{ route('tieuchuan.edit', ['id' => $item->id]) }}"
                                            class="btn btn-secondary">Sửa</a>
                                        @endcan
                                        @can('tieuchuan-xoa')
                                        <a href="#" class="btn btn-danger btn-delete"
                                            data-url="{{ route('tieuchuan.destroy') }}" data-id="{{ $item->id }}">Xóa</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="999" class="text-center">Chưa có bản ghi nào!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/handleDelete.js"></script>
@endsection
