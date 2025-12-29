@extends('template_admin.master')
@section('contents')

<section class="section">
    <div class="section-header">
        <h1>Dashboard System Magang SAI</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="hero text-white" style="background: linear-gradient(to right, #6a3093, #a044ff); border-radius: 15px; padding: 40px;">
                    <div class="hero-inner">
                        <h2>Halo, {{ Auth::user()->name }}!</h2>
                        <p class="lead">Selamat datang di panel kendali pendaftaran magang Sarastya Agility Innovations. Pantau pelamar dan kelola lowongan dengan mudah melalui dashboard ini.</p>
                        <div class="mt-4">
                            <a href="{{ url('data-lowongan') }}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-plus"></i> Kelola Lowongan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Lowongan Aktif -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 shadow-sm">
                    <div class="card-icon bg-info">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Lowongan Aktif</h4>
                        </div>
                        <div class="card-body">
                            {{ $data['count_lowongan'] }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pendaftar Baru -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 shadow-sm">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pendaftar Baru</h4>
                        </div>
                        <div class="card-body text-warning">
                            {{ $data['count_pendaftaran_baru'] }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diterima -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 shadow-sm">
                    <div class="card-icon bg-success">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Diterima</h4>
                        </div>
                        <div class="card-body">
                            {{ $data['count_diterima'] }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Akun Pelamar -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 shadow-sm">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Akun Pelamar</h4>
                        </div>
                        <div class="card-body">
                            {{ $data['total_pelamar'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4>Aksi Cepat</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <a href="{{ url('data-pendaftaran') }}" class="btn btn-primary btn-lg btn-block icon-left shadow-sm">
                                    <i class="fas fa-search"></i> Review Pendaftar Baru
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ url('data-lowongan') }}" class="btn btn-info btn-lg btn-block icon-left shadow-sm">
                                    <i class="fas fa-edit"></i> Update Lowongan Kerja
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ url('data-diterima') }}" class="btn btn-success btn-lg btn-block icon-left shadow-sm">
                                    <i class="fas fa-clipboard-list"></i> Lihat Data Peserta Lolos
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ url('data-pelamar') }}" class="btn btn-secondary btn-lg btn-block icon-left shadow-sm">
                                    <i class="fas fa-user-cog"></i> Manajemen Data User
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4>Status Sistem</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <div class="text-small font-weight-bold text-muted text-uppercase mb-1">Status Lowongan</div>
                            <div class="h5 font-weight-bold text-success"><i class="fas fa-circle pr-1"></i> Running Smoothly</div>
                        </div>
                        <hr>
                        <p class="text-muted small">Semua pendaftaran masuk akan muncul di Dashboard secara realtime.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection