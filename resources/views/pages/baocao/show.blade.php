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
    <link rel="stylesheet" href="css/tiny-editor.css">
    <style>
        .minhchung {
            display: block;
            text-decoration: none;
        }

        html {
            scroll-behavior: smooth;
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
    <div class="row">
        <div class="card shadow mb-4 col mx-3 p-0">
            <div class="card-body p-5">
                <h6 class="text-uppercase font-weight-bold text-dark text-center text-bold">Tiêu chí số 1.1. Kết quả đầu ra
                </h6>
                <p class="font-weight-bold text-dark">Mô tả</p>
                {!! $baoCao->moTa !!}
                <p class="font-weight-bold text-dark">Điểm mạnh</p>
                {!! $baoCao->diemManh !!}
                <p class="font-weight-bold text-dark">Điểm tồn tại</p>
                {!! $baoCao->diemTonTai !!}
                <p class="font-weight-bold text-dark">Kế hoạch hành động</p>
                {!! $baoCao->keHoachHanhDong !!}
                <p class="font-weight-bold text-dark">Điểm tự đánh giá</p>
                {!! $baoCao->diemTDG !!}/7
            </div>
            <div class="card-footer p-3">
                <div class="text-right">
                    <a href="{{ route('baocao.word', ['id' => $baoCao->id]) }}" class="btn btn-primary">Xuất Word</a>
                    <a href="{{ route('baocao.edit', ['id' => $baoCao->id]) }}" class="btn btn-secondary">Sửa</a>
                </div>
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
                                                    <h6><strong>@{{ message.nguoi_dung.hoTen }}</strong><small> (@{{ message.nguoi_dung.chucVu }})</small></h6>
                                                </div>
                                                <div class="col-4">
                                                    <div class="pull-right reply text-right">
                                                        <button @click="showReplyInput(message.id)" class="btn-phanhoi btn-link bg-transparent border-0"><span><i class="fa fa-reply"></i>
                                                            Phản hồi</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <span>
                                                @{{ message.noiDung }}
                                            </span>
                                            <div class="mt-4" :class="message.id == active ? activeClass : 'd-none'">
                                                <div class="input-group mb-3">
                                                    <input v-model="replyMessage" @keyup.enter="sendReplyMessage" class="form-control">
                                                    <div class="input-group-append">
                                                        <button @click="sendReplyMessage" class="btn btn-primary">Gửi phản hồi</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-if="message.child_binh_luan.length">
                                                <div v-for="childMessage in message.child_binh_luan">
                                                    <div class="media mt-4">
                                                        <a class="pr-3" href="#"><img
                                                                class="rounded-circle border border-primary" alt="avatar"
                                                                v-bind:src="childMessage.nguoi_dung.hinhAnh" /></a>
                                                        <div class="media-body">
                                                            <div class="row">
                                                                <div class="col-12 d-flex">
                                                                    <h6><strong>@{{ childMessage.nguoi_dung.hoTen }}</strong><small> (@{{ childMessage.nguoi_dung.chucVu }})</small></h6>
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
                                <div class="text-center">Chưa có bình luận nào. Hãy gửi nhận xét đầu tiên của bạn để xây dựng báo cáo nhé!</div>
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
@endsection

@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.6.14/vue.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/socket.io/2.4.0/socket.io.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.common.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/handleDelete.js"></script>
    <script>
        $(document).ready(function() {
            $listMinhChung = $('.list-minhchung');
            $('.is-minhchung').each((i, el) => {
                $(el).attr('id', `minhchung-${i + 1}`);
                $listMinhChung.append(
                    `<li><a class="minhchung" data-id="minhchung-${i + 1}" href="${window.location.href.split(/[?#]/)[0]}#minhchung-${i + 1}">${$(el).text()}</a></li>`
                );
            });
        });
    </script>
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
                        .here((users) => {
                            this.users = users
                        })
                        .listen('MessageSent', (event) => {
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
        })
    </script>
@endsection
