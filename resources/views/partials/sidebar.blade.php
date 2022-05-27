<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home.index') }}">
        <div class="sidebar-brand-icon">
            <img src="img/logo.png" alt="logo" width="50" height="50"/>
        </div>
        <div class="sidebar-brand-text mx-3">Đại học Nha Trang</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @include('partials.sidebar-menu-item', [
        'route' => 'home.index',
        'icon' => 'fas fa-fw fa-tachometer-alt',
        'title' => 'Trang chủ'
    ])

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Danh mục
    </div>

    @include('partials.sidebar-menu-item', [
        'route' => 'dotdanhgia.index',
        'icon' => 'fas fa-server',
        'title' => 'Đợt đánh giá'
    ])

    @include('partials.sidebar-menu-item', [
        'route' => 'tieuchuan.index',
        'icon' => 'fas fa-server',
        'title' => 'Tiêu chuẩn'
    ])

    @include('partials.sidebar-menu-item', [
        'route' => 'tieuchi.index',
        'icon' => 'fas fa-server',
        'title' => 'Tiêu chí'
    ])

    @include('partials.sidebar-menu-item', [
        'route' => 'nguoidung.index',
        'icon' => 'fas fa fa-user',
        'title' => 'Người dùng'
    ])

    @include('partials.sidebar-menu-item', [
        'route' => 'donvi.index',
        'icon' => 'fas fa-building',
        'title' => 'Đơn vị'
    ])

    @include('partials.sidebar-menu-item', [
        'route' => 'nganh.index',
        'icon' => 'fas fa-briefcase',
        'title' => 'Ngành'
    ])

    @include('partials.sidebar-menu-item', [
        'route' => 'nhom.index',
        'icon' => 'fas fa fa-users',
        'title' => 'Nhóm'
    ])

    @include('partials.sidebar-menu-item', [
        'route' => 'baocao.index',
        'icon' => 'fas fa fa-users',
        'title' => 'Báo cáo'
    ])

    @include('partials.sidebar-menu-item', [
        'route' => 'minhchung.index',
        'icon' => 'fas fa fa-users',
        'title' => 'Minh chứng'
    ])

    @include('partials.sidebar-menu-item', [
        'route' => 'vaitrohethong.index',
        'icon' => 'fas fa fa-users',
        'title' => 'Vai trò hệ thống'
    ])

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
