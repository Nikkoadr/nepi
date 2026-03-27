<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/img/logo_disdik.png') }}" alt="Logo" style="width:40px;">
        </div>
        <div class="sidebar-brand-text mx-2">Perizinan</div>
    </a>

    <hr class="sidebar-divider">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- DATA LEMBAGA -->
    <div class="sidebar-heading">
        Data Lembaga
    </div>

    <!-- PKBM -->
    <li class="nav-item {{ request()->routeIs('pkbm.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pkbm.index') }}">
            <i class="fas fa-fw fa-school"></i>
            <span>PKBM</span>
        </a>
    </li>

    <!-- LKP -->
    <li class="nav-item {{ request()->routeIs('lkp.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('lkp.index') }}">
            <i class="fas fa-fw fa-chalkboard-teacher"></i>
            <span>LKP</span>
        </a>
    </li>

    <!-- PAUD -->
    <li class="nav-item {{ request()->routeIs('paud.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('paud.index') }}">
            <i class="fas fa-fw fa-child"></i>
            <span>PAUD</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- LAPORAN -->
    <div class="sidebar-heading">
        Laporan
    </div>

    <li class="nav-item {{ request()->routeIs('laporan.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('laporan.index') }}">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Laporan Lembaga</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('laporan.izin') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('laporan.izin') }}">
            <i class="fas fa-fw fa-file-signature"></i>
            <span>Laporan Izin</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('laporan.expired') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('laporan.expired') }}">
            <i class="fas fa-fw fa-exclamation-triangle"></i>
            <span>Izin Kadaluarsa</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

</ul>