<style>
  .subatas {
    font-weight: bold;
    font-size: 10px;
    background-color: #6777ef;
    border-radius: 21px;
    color: white;
    padding: 6px;
  }
  .main-sidebar .sidebar-menu li.menu-header {
    text-transform: uppercase;
    letter-spacing: 1.3px;
    font-weight: 700;
  }
</style>
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand text-left pl-3">
        <a href="{{ url('dashboard') }}">
            <img src="{{ asset('assets_admin/img/profile_perusahaan/Logo 4 - Color Horizontal - No Background.png') }}" width="160" alt="" class="mt-3">
        </a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('dashboard') }}">SAI</a>
      </div>

      <ul class="sidebar-menu mt-4">
        <!-- Dashboard Section -->
        <li class="menu-header">Overview</li>
        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('dashboard') }}"><i class="fas fa-th-large"></i> <span>Dashboard</span></a>
        </li>

        <!-- Recruitment Section -->
        <li class="menu-header">Recruitment</li>
        <li class="{{ Request::is('data-lowongan') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('data-lowongan') }}"><i class="fas fa-briefcase"></i> <span>Kelola Lowongan</span></a>
        </li>
        <li class="{{ Request::is('data-pendaftaran') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('data-pendaftaran') }}">
            <i class="fas fa-user-edit"></i> <span>Lamaran Masuk</span>
            @if(isset($data_sidebar['pengajuan']) && $data_sidebar['pengajuan'] > 0)
              <span class="badge badge-warning ml-2">{{ $data_sidebar['pengajuan'] }}</span>
            @endif
          </a>
        </li>

        <!-- User Management -->
        <li class="menu-header">User Management</li>
        <li class="nav-item dropdown {{ Request::is('data-pelamar') || Request::is('data-admin') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Data Users</span></a>
          <ul class="dropdown-menu">
            <li class="{{ Request::is('data-pelamar') ? 'active' : '' }}"><a class="nav-link" href="{{ url('data-pelamar') }}">Data Pelamar</a></li>
            <li class="{{ Request::is('data-admin') ? 'active' : '' }}"><a class="nav-link" href="{{ url('data-admin') }}">Data Admin</a></li>
          </ul>
        </li>

        <!-- Reports Section -->
        <li class="menu-header">Laporan & Hasil</li>
        <li class="{{ Request::is('data-diterima') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('data-diterima') }}"><i class="fas fa-check-circle"></i> <span>Peserta Lolos</span></a>
        </li>
        <li class="{{ Request::is('data-tidak-diterima') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('data-tidak-diterima') }}"><i class="fas fa-times-circle"></i> <span>Pelamar Ditolak</span></a>
        </li>

        <!-- Template Stubs (Optional: Alur untuk UI Depan) -->
        <li class="menu-header">Pengaturan Landing</li>
        <li class="{{ Request::is('data-alur') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('data-alur') }}"><i class="fas fa-route"></i> <span>Update Alur Magang</span></a>
        </li>
      </ul>

      <div class="mt-4 mb-4 p-3 hide-sidebar-mini text-center">
        <a href="{{ url('logout') }}" class="btn btn-danger btn-lg btn-block btn-icon-left shadow-sm">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </aside>
</div>