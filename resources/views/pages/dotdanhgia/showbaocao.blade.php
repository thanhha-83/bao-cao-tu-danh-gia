@extends('layouts.index', [
    'title' => 'Bản báo cáo tự đánh giá',
    'isShowBaoCao' => true,
    'tieuChuans' => $tieuChuans,
])

@php
$controller = (object) [
    'name' => 'Báo cáo',
    'href' => '/dotdanhgia',
];
$action = (object) [
    'name' => 'Chi tiết',
];
@endphp

@section('styles')
    <link rel="stylesheet" href="css/style-word.css">
    <style>
        .minhchung {
            display: block;
            text-decoration: none;
        }
    </style>
@endsection

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
    {{-- Content --}}
    <div class="row">
        <div class="card shadow mb-4 col mx-3 p-0">
            <div class="wrap-word-content card-body p-5">
                <h1>TỰ ĐÁNH GIÁ THEO CÁC TIÊU CHUẨN, TIÊU CHÍ</h1>
                @foreach ($tieuChuans as $tieuChuan)
                    <h2>TIÊU CHUẨN {{ $tieuChuan->stt }}. {{ $tieuChuan->ten }}</h2>
                    <h3 id="modau-tieuchuan-{{ $tieuChuan->stt }}">Mở đầu</h3>
                    @php
                        $ketLuanBaoCao = $tieuChuan->tieuChi[0]->baoCao
                            ->where('nganh_id', $nganh->id)
                            ->where('dotDanhGia_id', $nganh->dotDanhGia_id)
                            ->first();
                    @endphp
                    {!! $ketLuanBaoCao->moDau !!}
                    @foreach ($tieuChuan->tieuChi as $tieuChi)
                        @if ($loop->first)
                            @continue
                        @endif
                        <h3 id="tieuchi-{{ $tieuChuan->stt }}-{{ $tieuChi->stt }}">Tiêu chí số {{ $tieuChuan->stt }}.{{ $tieuChi->stt }}. {{ $tieuChi->ten }}</h3>
                        @php
                            $baoCao = $tieuChi->baoCao
                                ->where('nganh_id', $nganh->id)
                                ->where('dotDanhGia_id', $nganh->dotDanhGia_id)
                                ->first();
                            $html = html_entity_decode($baoCao->moTa);
                            foreach ($hopMCs as $hopMC) {
                                $html = str_replace($hopMC->text, $hopMC->maHMC, $html);
                            }
                            $baoCao->moTa = $html;
                        @endphp
                        <p class="h3">1. Mô tả hiện trạng</p>
                        {!! $baoCao->moTa !!}
                        <p class="h3">2. Điểm mạnh</p>
                        {!! $baoCao->diemManh !!}
                        <p class="h3">3. Điểm tồn tại</p>
                        {!! $baoCao->diemTonTai !!}
                        <p class="h3">4. Kế hoạch hành động</p>
                        {!! $baoCao->keHoachHanhDong !!}
                        <p class="h3">5. Tự đánh giá</p>
                        <p>{!! $baoCao->diemTDG >= 4 ? 'Đạt' : 'Chưa đạt' !!} (Điểm TĐG: {!! $baoCao->diemTDG !!}/7)</p>
                    @endforeach
                    <h3 id="ketluan-tieuchuan-{{ $tieuChuan->stt }}">Kết luận về Tiêu chuẩn {{ $tieuChuan->stt }}</h3>
                    {!! $ketLuanBaoCao->ketLuan !!}
                    <p class="h3">Tổng số tiêu chí đạt yêu cầu:
                        {{ $ketLuanBaoCao->soTCDat }}/{{ $ketLuanBaoCao->tongSoTC }}</p>
                @endforeach
            </div>
        </div>
        <div class="mb-4 col-md-3 mx-2">
            <div class="card shadow">
                <div class="card-body py-5">
                    <h6 class="text-uppercase font-weight-bold text-dark text-center text-bold">Minh chứng sử dụng</h6>
                    <hr class="divider">
                    <ul class="list-minhchung pr-2 pl-4"></ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- <script src="js/handleScrollToMinhChung.js"></script> --}}
    <script src="js/handleScrollToBaoCao.js"></script>
@endsection
