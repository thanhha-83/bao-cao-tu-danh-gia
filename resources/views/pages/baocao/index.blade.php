@extends('layouts.index', ['title' => 'Danh sách báo cáo'])

@php
$controller = (object) [
    'name' => 'Báo cáo',
    'href' => '/baocao',
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
            @can('baocao-them')
            <a href="{{ route('baocao.create') }}" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Thêm mới</span>
            </a>
            @endcan
            @can('baocao-thungrac')
            <a href="{{ route('baocao.trash') }}" class="btn btn-dark btn-icon-split">
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
                            <th>Thời gian cập nhật</th>
                            <th>Cán bộ đảm nhận viết</th>
                            <th>Ngành</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($baoCaos) > 0)
                            @foreach ($baoCaos as $item)
                                <tr>
                                    <td>Báo cáo số {{ $item->tieuChi->tieuChuan->stt }}.{{ $item->tieuChi->stt }}</td>
                                    <td>{{ date("d-m-Y H:i", strtotime($item->updated_at)) }}</td>
                                    <td>
                                        <ul class="pl-0" type="none">
                                        @foreach ($item->nhomNguoiDung as $nhomNguoiDung)
                                            <li>{{ $nhomNguoiDung->nguoiDung->hoTen }}</li>
                                        @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $item->nganh->ten }}</td>
                                    <td>
                                        <a href="{{ route('baocao.show', ['id' => $item->id]) }}"
                                            class="btn btn-primary">Xem chi tiết</a>
                                        @can('baocao-sua', $item->id)
                                        <a href="{{ route('baocao.edit', ['id' => $item->id]) }}"
                                            class="btn btn-secondary">Sửa</a>
                                        <a href="#" class="btn btn-success btn-backup"
                                            data-url="{{ route('baocao.backup', ['id' => $item->id]) }}" data-id="{{ $item->id }}">Sao lưu</a>
                                        @endcan
                                        @can('baocao-dieukhien', $item->id)
                                        @if ($item->trangThai == 0)
                                        <a href="#" class="btn btn-info btn-finish"
                                            data-url="{{ route('baocao.finish', ['id' => $item->id]) }}" data-id="{{ $item->id }}">Hoàn thành</a>
                                        @else
                                        <a href="#" class="btn btn-info btn-reopen"
                                        data-url="{{ route('baocao.reopen', ['id' => $item->id]) }}" data-id="{{ $item->id }}">Mở lại</a>
                                        @endif
                                        @endcan
                                        @can('baocao-xoa', $item->id)
                                        <a href="#" class="btn btn-danger btn-delete"
                                            data-url="{{ route('baocao.destroy', ['id' => $item->id]) }}" data-id="{{ $item->id }}">Xóa</a>
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
    <script src="js/handleBackup.js"></script>
    <script src="js/handleFinishBaoCao.js"></script>
@endsection
