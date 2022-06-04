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

    @can('dotdanhgia-danhsach')
    @include('partials.sidebar-menu-item', [
        'route' => 'dotdanhgia.index',
        'icon' => 'fas fa-server',
        'title' => 'Đợt đánh giá'
    ])
    @endcan

    @can('tieuchuan-danhsach')
    @include('partials.sidebar-menu-item', [
        'route' => 'tieuchuan.index',
        'icon' => 'fas fa-server',
        'title' => 'Tiêu chuẩn'
    ])
    @endcan

    @can('tieuchi-danhsach')
    @include('partials.sidebar-menu-item', [
        'route' => 'tieuchi.index',
        'icon' => 'fas fa-server',
        'title' => 'Tiêu chí'
    ])
    @endcan

    @can('nguoidung-danhsach')
    @include('partials.sidebar-menu-item', [
        'route' => 'nguoidung.index',
        'icon' => 'fas fa fa-user',
        'title' => 'Người dùng'
    ])
    @endcan

    @can('donvi-danhsach')
    @include('partials.sidebar-menu-item', [
        'route' => 'donvi.index',
        'icon' => 'fas fa-building',
        'title' => 'Đơn vị'
    ])
    @endcan

    @can('nganh-danhsach')
    @include('partials.sidebar-menu-item', [
        'route' => 'nganh.index',
        'icon' => 'fas fa-briefcase',
        'title' => 'Ngành'
    ])
    @endcan

    @can('nhom-danhsach')
    @include('partials.sidebar-menu-item', [
        'route' => 'nhom.index',
        'icon' => 'fas fa fa-users',
        'title' => 'Nhóm'
    ])
    @endcan

    @can('minhchung-danhsach')
    @include('partials.sidebar-menu-item', [
        'route' => 'minhchung.index',
        'icon' => 'fas fa fa-users',
        'title' => 'Minh chứng'
    ])
    @endcan

    @can('vaitrohethong-danhsach')
    @include('partials.sidebar-menu-item', [
        'route' => 'vaitrohethong.index',
        'icon' => 'fas fa fa-users',
        'title' => 'Vai trò hệ thống'
    ])
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Tự đánh giá
    </div>

    @can('quanlynhom')
    @include('partials.sidebar-menu-item', [
        'route' => 'quanlynhom.index',
        'icon' => 'fas fa fa-users',
        'title' => 'Quản lý nhóm'
    ])
    @endcan

    @can(['baocao-them', 'baocao-sua'])
    @include('partials.sidebar-menu-item', [
        'route' => 'baocao.index',
        'icon' => 'fas fa fa-users',
        'title' => 'Viết báo cáo'
    ])
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
