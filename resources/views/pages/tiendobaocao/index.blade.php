@extends('layouts.index', ['title' => 'Quản lý nhóm'])

@php
$controller = (object) [
    'name' => 'Quản lý nhóm',
    'href' => '/quanlynhom',
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
                            <th>Ngành</th>
                            <th>Năm học</th>
                            <th>Chức năng</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nganhs as $key => $nganh)
                        @php
                            $canExport = true;
                            foreach ($tieuChuans as $key => $tieuChuan) {
                                foreach ($tieuChuan->tieuChi as $key => $tieuChi) {
                                    $baoCao = $tieuChi->baoCao->where('nganh_id', $nganh->id)->where('dotDanhGia_id', $nganh->dotDanhGia_id)->first();
                                    if (empty($baoCao) || ($baoCao && $baoCao->trangThai == 0)) {
                                        $canExport = false;
                                        break; break;
                                    }
                                }
                            }
                        @endphp
                        <tr data-toggle="collapse" data-target="#nganh-{{$nganh->id}}{{$key}}" class="accordion-toggle">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $nganh->ten }}</td>
                            <td>{{ $nganh->namHoc }}</td>
                            <td>
                                @if ($canExport)
                                <a href="#" class="btn btn-primary">Xuất báo cáo</a>
                                @else
                                <a href="#" class="btn btn-secondary disabled">Xuất báo cáo</a>
                                @endif
                            </td>
                            <td><button class="btn btn-default btn-xs"><i class="fas fa-plus"></i></button></td>
                        </tr>
                        <tr>
                            <td colspan="12" class="hiddenRow">
                                <div class="accordian-body collapse" id="nganh-{{$nganh->id}}{{$key}}">
                                    <table class="table table-bordered bg-light" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="info">
                                                <th>STT tiêu chuẩn</th>
                                                <th>Tên tiêu chuẩn</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tieuChuans as $key => $tieuChuan)
                                            <tr data-toggle="collapse" class="accordion-toggle" data-target="#tieuChuan-{{ $nganh->id }}{{$key}}">
                                                <td>Tiêu chuẩn số {{ $tieuChuan->stt }}</td>
                                                <td>{{ $tieuChuan->ten }}</td>
                                                <td><button class="btn btn-default btn-xs"><i class="fas fa-plus"></i></button></td>
                                            </tr>
                                            <tr>
                                                <td colspan="12" class="hiddenRow">
                                                    <div class="accordian-body collapse" id="tieuChuan-{{ $nganh->id }}{{$key}}">
                                                        <table class="table table-bordered bg-gradient-light" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>STT tiêu chí</th>
                                                                    <th>Tên tiêu chí</th>
                                                                    <th>Báo cáo</th>
                                                                    <th>Trạng thái</th>
                                                                    <th>Cán bộ đảm nhận</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($tieuChuan->tieuChi as $key => $tieuChi)
                                                                    <tr>
                                                                        <td>Tiêu chí số {{ $tieuChuan->stt }}.{{ $tieuChi->stt }}</td>
                                                                        <td>{{ $tieuChi->ten }}</td>
                                                                        @php
                                                                            $baoCao = $tieuChi->baoCao->where('nganh_id', $nganh->id)->where('dotDanhGia_id', $nganh->dotDanhGia_id)->first();
                                                                            $ten = '<span class="text-danger">Chưa có</span>';
                                                                            $trangThai = '<span class="text-danger">Chưa có</span>';
                                                                            $canBoDamNhan = '<span class="text-danger">Chưa có</span>';
                                                                            if (!empty($baoCao)) {
                                                                                $ten = 'Báo cáo số ' . $baoCao->tieuChuan->stt . '.' . $baoCao->tieuChi->stt;
                                                                                $trangThai = $baoCao->trangThai == 0 ? 'Đang tiến hành' : 'Đã hoàn thành';
                                                                                $canBoDamNhan = '<ul class="pl-0" type="none">';
                                                                                foreach ($baoCao->nhomNguoiDung as $nhomNguoiDung) {
                                                                                    $canBoDamNhan .= '<li>' . $nhomNguoiDung->nguoiDung->hoTen . '</li>';
                                                                                }
                                                                                $canBoDamNhan .= '</ul>';
                                                                            }
                                                                        @endphp
                                                                        <td>{!! $ten !!}</td>
                                                                        <td>{!! $trangThai !!}</td>
                                                                        <td>{!! $canBoDamNhan !!}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
