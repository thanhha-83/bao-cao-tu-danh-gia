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

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Trang chủ</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Danh mục
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tieuchuan.index') }}">
            <i class="fas fa-server"></i>
            <span>Tiêu chuẩn</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tieuchi.index') }}">
            <i class="fas fa-server"></i>
            <span>Tiêu chí</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('nguoidung.index') }}">
            <i class="fas fa fa-user"></i>
            <span>Người dùng</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('donvi.index') }}">
            <i class="fas fa-building"></i>
            <span>Đơn vị</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('nganh.index') }}">
            <i class="fas fa-briefcase"></i>
            <span>Ngành</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('nhom.index') }}">
            <i class="fas fa fa-users"></i>
            <span>Nhóm</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
