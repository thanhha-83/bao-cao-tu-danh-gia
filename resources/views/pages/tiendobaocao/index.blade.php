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
                            <th>Nhóm</th>
                            <th>Ngành</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
                            <td>1</td>
                            <td>Nhóm 1</td>
                            <td>Công nghệ thông tin</td>
                            <td><button class="btn btn-default btn-xs"><i class="fas fa-plus"></i></button></td>
                        </tr>
                        <tr>
                            <td colspan="12" class="hiddenRow">
                                <div class="accordian-body collapse" id="demo1">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="info">
                                                <th>STT tiêu chuẩn</th>
                                                <th>Tên tiêu chuẩn</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr data-toggle="collapse" class="accordion-toggle" data-target="#demo10">
                                                <td>Tiêu chuẩn số 1</td>
                                                <td>Mục tiêu và chuẩn đầu ra của chương trình đào tạo</td>
                                                <td><button class="btn btn-default btn-xs"><i class="fas fa-plus"></i></button></td>
                                            </tr>
                                            <tr>
                                                <td colspan="12" class="hiddenRow">
                                                    <div class="accordian-body collapse" id="demo10">
                                                        <table class="table table-bordered" width="100%" cellspacing="0">
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
                                                                <tr>
                                                                    <td>Tiêu chí 1.0</td>
                                                                    <td>Tổng kết tiêu chuẩn 1</td>
                                                                    <td>Báo cáo số 1.0</td>
                                                                    <td>Đang tiến hành</td>
                                                                    <td>Phan Thanh Hà</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <tr data-toggle="collapse" data-target="#demo2" class="accordion-toggle">
                            <td>1</td>
                            <td>Nhóm 1</td>
                            <td>Công nghệ thông tin</td>
                            <td><button class="btn btn-default btn-xs"><i class="fas fa-plus"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
