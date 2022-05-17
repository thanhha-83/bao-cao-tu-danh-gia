@extends('layouts.index', ['title' => 'Chi tiết đợt đánh giá'])

@php
$controller = (object) [
    'name' => 'Đợt đánh giá',
    'href' => '/dotdanhgia',
];
$action = (object) [
    'name' => 'Chi tiết',
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
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <th>Tên đợt đánh giá:</th>
                            <td colspan="3">{{ $dotDanhGia->ten }}</td>
                        </tr>
                        <tr>
                            <th>Năm đánh giá:</th>
                            <td colspan="3">{{ $dotDanhGia->namHoc }}</td>
                        </tr>
                        <tr>
                            <th>Ngành:</th>
                            <td colspan="3">
                                <ul class="pl-3">
                                    @foreach ($dotDanhGia->nganh as $item)
                                        <li>{{ $item->ten }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>Giai đoạn:</th>
                            <th>Hoạt động</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                        </tr>
                        @foreach ($dotDanhGia->giaiDoan as $item)
                            <tr>
                                <td></td>
                                <td>{{ $item->hoatDong->ten }}</td>
                                <td>{{ date("d-m-Y H:i", strtotime($item->ngayBD)) }}</td>
                                <td>{{ date("d-m-Y H:i", strtotime($item->ngayKT)) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th>Chức năng:</th>
                            <td colspan="3">
                                <a href="{{ route('dotdanhgia.edit', ['id' => $dotDanhGia->id]) }}"
                                    class="btn btn-secondary">Sửa</a>
                                <a href="#" class="btn btn-danger btn-delete" data-url="{{ route('dotdanhgia.destroy') }}"
                                    data-id="{{ $dotDanhGia->id }}"
                                    data-redirect="{{ route('dotdanhgia.index') }}">Xóa</a>
                            </td>
                        </tr>
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
