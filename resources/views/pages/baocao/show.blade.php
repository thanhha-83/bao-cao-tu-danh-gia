@extends('layouts.index', ['title' => 'Chi tiết tiêu chuẩn'])

@php
$controller = (object) [
    'name' => 'Tiêu chuẩn',
    'href' => '/tieuchuan',
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
                            <th>Tiêu chuẩn số:</th>
                            <td>{{ $tieuChuan->stt }}</td>
                        </tr>
                        <tr>
                            <th>Tên tiêu chuẩn:</th>
                            <td>{{ $tieuChuan->ten }}</td>
                        </tr>
                        <tr>
                            <th>Nội dung:</th>
                            <td>{{ $tieuChuan->noiDung }}</td>
                        </tr>
                        <tr>
                            <th>Chức năng:</th>
                            <td>
                                <a href="{{ route('tieuchuan.edit', ['id' => $tieuChuan->id]) }}"
                                    class="btn btn-secondary">Sửa</a>
                                <a href="#" class="btn btn-danger btn-delete" data-url="{{ route('tieuchuan.destroy') }}"
                                    data-id="{{ $tieuChuan->id }}" data-redirect="{{ route('tieuchuan.index') }}">Xóa</a>
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
