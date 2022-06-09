@php
header('Content-Type: application/vnd.msword');
header('Content-Disposition: attachment; filename="baocao.doc"');
header('Cache-Control: private, max-age=0, must-revalidate');
@endphp

<head>
    <title>Export HTML to WORD</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 1.25cm 2cm 1.5cm 2cm;
        }

        body {
            text-align: justify;
            line-height: 150%;
        }
        p {
            font-size: 17.333333px;
            margin-top: 0;
            padding-top: 0;
            text-align: justify;
            text-indent: 37.467px;
            line-height: 150%;
        }

        table {
            font-size: 17.333333px;
        }

        h1 {
            font-size: 18.6666666667px;
            margin-bottom: 0;
            padding-bottom: 0;
            line-height: 130%;
        }

        h2,
        h3,
        .h3 {
            font-size: 17.333333px;
            margin-bottom: 0;
            padding-bottom: 0;
            text-indent: 37.467px;
        }

        h1,
        h2 {
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
        }
        h3, .h3 {
            font-weight: bold;
        }

        a.is-minhchung,
        a.is-minhchung:visited,
        a.is-minhchung:focus,
        a.is-minhchung:hover {
            color: #000;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div id="page-content">
        <h1>TỰ ĐÁNH GIÁ THEO CÁC TIÊU CHUẨN, TIÊU CHÍ</h1>
        <h2>TIÊU CHUẨN 1. MỤC TIÊU VÀ CHUẨN ĐẦU RA CỦA CHƯƠNG TRÌNH ĐÀO TẠO</h2>
        <h3>Tiêu chí 1.1. Mục tiêu của chương trình đào tạo được xác định rõ ràng, phù hợp với sứ mạng và tầm nhìn của
            cơ sở giáo dục đại học, phù hợp với mục tiêu của giáo dục đại học quy định tại Luật Giáo dục Đại học</h3>
        <p class="h3">1. Mô tả hiện trạng</p>
        {!! $baoCao->moTa !!}
        <p class="h3">2. Điểm mạnh</p>
        {!! $baoCao->diemManh !!}
        <p class="h3">3. Điểm tồn tại</p>
        {!! $baoCao->diemTonTai !!}
        <p class="h3">4. Kế hoạch hành động</p>
        {!! $baoCao->keHoachHanhDong !!}
        <p class="h3">5. Tự đánh giá</p>
        <p>{!! $baoCao->diemTDG > 4 ? 'Đạt' : 'Chưa đạt' !!}(Điểm TĐG: {!! $baoCao->diemTDG !!}/7)</p>
    </div>
</body>

</html>
