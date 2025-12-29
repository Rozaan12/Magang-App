@extends('template_admin.master')
@section('contents')

<section class="section">
    <div class="section-header">
        <h1>{{$data['title']}}</h1>
    </div>
    <div class="section-body">
        <div class="card shadow-sm">
            <div class="card-body">
                <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Sekolah/PT</th>
                            <th>Jurusan</th>
                            <th>Status Akun</th>
                            <th class="text-center" width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['data_pelamar'] as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->sekolah ?? '-' }}</td>
                                <td>{{ $item->jurusan ?? '-' }}</td>
                                <td>
                                    @if ($item->status == 1)
                                        <div class="badge badge-success">Aktif</div>
                                    @else
                                        <div class="badge badge-warning">Menunggu Verif</div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#Detail{{$item->id}}" title="Lihat Profil Lengkap">
                                        <i class="fa fa-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@foreach ($data['data_pelamar'] as $item)
<div class="modal fade" id="Detail{{$item->id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title">Profil Lengkap Pelamar</h4>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Data Akun -->
                    <div class="col-md-6">
                        <h6 class="text-primary font-weight-bold">Informasi Akun</h6>
                        <table class="table table-sm table-borderless">
                            <tr><td width="30%">Nama Akun</td><td>: {{ $item->name }}</td></tr>
                            <tr><td>Email</td><td>: {{ $item->email }}</td></tr>
                            <tr><td>No WA</td><td>: {{ $item->no_telp }}</td></tr>
                            <tr><td>Telegram</td><td>: {{ $item->username_telegram ?? '-' }}</td></tr>
                        </table>
                    </div>
                    <!-- Data Akademik -->
                    <div class="col-md-6">
                        <h6 class="text-primary font-weight-bold">Data Akademik</h6>
                        <table class="table table-sm table-borderless">
                            <tr><td width="30%">Sekolah/PT</td><td>: {{ $item->sekolah ?? '-' }}</td></tr>
                            <tr><td>Jurusan</td><td>: {{ $item->jurusan ?? '-' }}</td></tr>
                            <tr><td>Prodi</td><td>: {{ $item->program_studi ?? '-' }}</td></tr>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <!-- Berkas -->
                    <div class="col-md-12">
                        <h6 class="text-primary font-weight-bold">Berkas Pendukung</h6>
                        <div class="d-flex flex-wrap">
                            @if($item->cv)
                                <a href="{{ url('berkas/'.$item->cv) }}" target="_blank" class="btn btn-sm btn-outline-warning mr-2 mb-2">
                                    <i class="fa fa-file-pdf"></i> Lihat CV
                                </a>
                            @endif
                            @if($item->portofolio_file)
                                <a href="{{ url('berkas/'.$item->portofolio_file) }}" target="_blank" class="btn btn-sm btn-outline-info mr-2 mb-2">
                                    <i class="fa fa-file-pdf"></i> Portofolio (File)
                                </a>
                            @endif
                            @if($item->portofolio_link)
                                <a href="{{ $item->portofolio_link }}" target="_blank" class="btn btn-sm btn-outline-primary mb-2">
                                    <i class="fa fa-link"></i> Link Portofolio
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <h6 class="text-primary font-weight-bold">Alamat Domisili</h6>
                <p class="text-muted">{{ $item->alamat_lengkap ?? $item->alamat }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
