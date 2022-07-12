@extends('layouts.index', ['title' => 'Chi tiết báo cáo'])

@php
$controller = (object) [
    'name' => 'Báo cáo',
    'href' => '/baocao',
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

        .media img {
            width: 60px;
            height: 60px;
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
                <h3>Tiêu chí số {{ $baoCao->tieuChi->tieuChuan->stt }}.{{ $baoCao->tieuChi->stt }}. {{ $baoCao->tieuChi->ten }}</h3>
                @if ($baoCao->tieuChi->stt !== 0)
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
                @else
                <h3>Mở đầu</h3>
                {!! $baoCao->moDau !!}
                <h3>Kết luận</h3>
                {!! $baoCao->ketLuan !!}
                <h3>Số tiêu chí đạt</h3>
                <p>{!! $baoCao->soTCDat !!}</p>
                @endif
            </div>
        </div>
        @if ($baoCao->tieuChi->stt !== 0)
        <div class="mb-4 col-md-3 mx-2">
            <div class="card shadow">
                <div class="card-body py-5">
                    <h6 class="text-uppercase font-weight-bold text-dark text-center text-bold">Minh chứng sử dụng</h6>
                    <hr class="divider">
                    <ul class="list-minhchung pr-2 pl-4"></ul>
                </div>
            </div>
        </div>
        @endif
    </div>
    {{-- Chat --}}
    <div class="app-chat-realtime card shadow mx-1">
        <div class="card-body p-5">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-uppercase font-weight-bold text-dark text-center text-bold">
                        Nhận xét báo cáo
                    </h3>
                    <hr class="divider mt-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div v-if="messages.length">
                                <div v-for="(message, i) in messages">
                                    <div class="media mt-4">
                                        <img class="mr-3 rounded-circle border border-primary" alt="Avatar"
                                            v-bind:src="message.nguoi_dung.hinhAnh" />
                                        <div class="media-body">
                                            <div class="row">
                                                <div class="col-8 d-flex">
                                                    <h6><strong>@{{ message.nguoi_dung.hoTen }}</strong><small>
                                                            (@{{ message.nguoi_dung.chucVu }})</small><small data-toggle="tooltip"
                                                            data-placement="top" :title="message.timeNum">
                                                            (@{{ message.time }})</small></h6>
                                                </div>
                                                <div class="col-4">
                                                    <div class="pull-right reply text-right">
                                                        <button @click="showReplyInput(message.id)"
                                                            class="btn-phanhoi btn-link bg-transparent border-0"><span><i
                                                                    class="fa fa-reply"></i>
                                                                Phản hồi</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <span>
                                                @{{ message.noiDung }}
                                            </span>
                                            <div class="mt-4"
                                                :class="message.id == active ? activeClass : 'd-none'">
                                                <div class="input-group mb-3">
                                                    <input v-model="replyMessage" @keyup.enter="sendReplyMessage"
                                                        class="form-control">
                                                    <div class="input-group-append">
                                                        <button @click="sendReplyMessage" class="btn btn-primary">Gửi phản
                                                            hồi</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-if="message.child_binh_luan.length">
                                                <div v-for="childMessage in message.child_binh_luan">
                                                    <div class="media mt-4">
                                                        <span class="pr-3"><img
                                                                class="rounded-circle border border-primary" alt="avatar"
                                                                v-bind:src="childMessage.nguoi_dung.hinhAnh" /></span>
                                                        <div class="media-body">
                                                            <div class="row">
                                                                <div class="col-12 d-flex">
                                                                    <h6><strong>@{{ childMessage.nguoi_dung.hoTen }}</strong><small>
                                                                            (@{{ childMessage.nguoi_dung.chucVu }})</small><small
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            :title="childMessage.timeNum">
                                                                            (@{{ childMessage.time }})</small></h6>
                                                                </div>
                                                            </div>
                                                            <span>
                                                                @{{ childMessage.noiDung }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <div class="text-center">Chưa có bình luận nào. Hãy gửi nhận xét đầu tiên của bạn để xây
                                    dựng báo cáo nhé!</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer px-5 py-4 text-right">
            <input @focus="active = null" v-model="message" @keyup.enter="sendMessage" class="form-control mb-4">
            <button @click="sendMessage" href="#" class="btn btn-primary">Gửi bình luận</button>
        </div>
    </div>
    <button type="button" class="btn-show-modal btn btn-primary d-none" data-toggle="modal" data-target="#deleteCatModal">
        <span class="sr-only">Show modal</span>
    </button>
    <!-- Modal -->
    <div class="modal fade" id="deleteCatModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Minh chứng thành phần</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="title"></h5>
                    <ul class="content"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/handleDelete.js"></script>
    <script src="js/handleRestore.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.6.14/vue.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/socket.io/2.4.0/socket.io.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.common.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/locale/vi.min.js"
        integrity="sha512-LvYVj/X6QpABcaqJBqgfOkSjuXv81bLz+rpz0BQoEbamtLkUF2xhPNwtI/xrokAuaNEQAMMA1/YhbeykYzNKWg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/handleDelete.js"></script>
    <script src="js/handleScrollToMinhChung.js"></script>
    <script>
        $(document).ready(function() {
            const _token = $('meta[name="csrf-token"]').attr('content');
            const initMessages = getInitMessages();

            function getInitMessages() {
                var remote;
                $.ajax({
                    type: "POST",
                    url: '/binhluan/show',
                    async: false,
                    data: {
                        id: {{ $baoCao->id }},
                        _token
                    },
                    success: (data) => {
                        remote = data;
                    },
                });
                remote.forEach((item) => {
                    item = formatDate(item);
                    item.child_binh_luan.forEach((childItem) => {
                        childItem = formatDate(childItem);
                    })
                })
                return remote;
            }
            new Vue({
                el: ".app-chat-realtime",
                data() {
                    return {
                        id: {{ auth()->id() }},
                        message: "",
                        replyMessage: "",
                        users: [],
                        messages: initMessages,
                        room: "",
                        activeClass: 'd-block',
                        active: null
                    }
                },
                methods: {
                    sendMessage() {
                        axios.post('/binhluan/store', {
                            message: this.message,
                            baoCao_id: {{ $baoCao->id }}
                        })
                        this.message = ""
                    },
                    sendReplyMessage() {
                        axios.post('/binhluan/storeReply', {
                            message: this.replyMessage,
                            baoCao_id: {{ $baoCao->id }},
                            parent_id: this.active
                        })
                        this.replyMessage = ""
                    },
                    showReplyInput(i) {
                        if (this.active === i) {
                            this.active = null;
                        } else {
                            this.active = i;
                        }
                    }
                },
                mounted() {
                    const echo = new Echo({
                        broadcaster: "socket.io",
                        host: window.location.hostname + ':6001',
                    })
                    echo.join('room.' + {{ $baoCao->id }})
                        .listen('MessageSent', (event) => {
                            event.binhLuan = formatDate(event.binhLuan);
                            if (event.action === 'isReply') {
                                this.messages.forEach((message, index) => {
                                    if (event.binhLuan.parent_id === message.id) {
                                        message.child_binh_luan.push(event.binhLuan);
                                    }
                                });
                            } else {
                                this.messages.push(event.binhLuan);
                            }
                        });
                },
            })

            function eventTooltip() {
                $('[data-toggle="tooltip"]').tooltip()
            }
            eventTooltip()

            function formatDate(item) {
                const dates = new Date(item.created_at);
                const year = (dates.getYear() + 1900).toString();
                const month = '0' + (dates.getMonth() + 1).toString();
                const date = dates.getDate().toString();
                const hours = dates.getHours().toString();
                const minutes = dates.getMinutes().toString();
                const dateString = year + month + date + hours + minutes;
                item.time = moment(dateString, "YYYYMMDDHm").fromNow();
                item.timeNum = moment(dates).format('LLL');
                return item;
            }
        })
    </script>
@endsection
