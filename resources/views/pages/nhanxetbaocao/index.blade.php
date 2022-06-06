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
                                        @can('nhanxetbaocao-binhluan', $item->id)
                                        <a href="{{ route('nhanxetbaocao.show', ['id' => $item->id]) }}"
                                            class="btn btn-primary">Nhận xét</a>
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
