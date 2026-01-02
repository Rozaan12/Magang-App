@extends('template_admin.master')
@section('contents')

<section class="section">
    <div class="section-header">
    <h1>{{$data['title']}}</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                @if (session()->has('err_message'))
                    <div class="alert alert-danger alert-dismissible" role="alert" auto-close="120">
                        <strong>Error! </strong>{{ session()->get('err_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('suc_message'))
                    <div class="alert alert-success alert-dismissible" role="alert" auto-close="120">
                        <strong>Success! </strong>{{ session()->get('suc_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- SISI KIRI: PROFIL & BERKAS -->
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center">
                                <h6 class="text-muted mb-3">Foto Profil</h6>
                                <div class="mb-4">
                                    <img src="<?= asset('')?>gambar/<?= $data['detail_pendaftaran']->gambar?>" alt="Profile" class="img-fluid rounded shadow-sm" style="max-height: 250px; width: 100%; object-fit: cover;">
                                </div>
                                <hr>
                                <h6 class="text-muted mb-3">Berkas Pendaftaran</h6>
                                <div class="d-flex flex-column gap-2">
                                    <a href="{{ url('berkas/'.$data['detail_pendaftaran']->ktp)}}" download class="btn btn-primary btn-sm btn-block mb-2"><i class="fas fa-id-card"></i> Download KTP</a>
                                    <a href="{{ url('berkas/'.$data['detail_pendaftaran']->cv)}}" download class="btn btn-warning btn-sm btn-block mb-2"><i class="fas fa-file-pdf"></i> Download CV</a>
                                    <a href="{{ url('berkas/'.$data['detail_pendaftaran']->surat_rekomendasi)}}" download class="btn btn-info btn-sm btn-block mb-2"><i class="fas fa-file-invoice"></i> Surat Rekomendasi</a>
                                    <a href="{{ url('berkas/'.$data['detail_pendaftaran']->proposal)}}" download class="btn btn-dark btn-sm btn-block"><i class="fas fa-file-alt"></i> Download Proposal</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SISI KANAN: DATA LENGKAP -->
                    <div class="col-md-8">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="text-primary mb-4 pb-2 border-bottom"><i class="fas fa-user"></i> Informasi Pelamar</h5>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nama Lengkap</label>
                                            <input type="text" class="form-control" value="{{$data['detail_pendaftaran']->nama_lengkap}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Email</label>
                                            <input type="text" class="form-control" value="{{$data['detail_pendaftaran']->email}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">No. Telepon/WhatsApp</label>
                                            <input type="text" class="form-control" value="{{$data['detail_pendaftaran']->no_telp}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Tempat Lahir</label>
                                            <input type="text" class="form-control" value="{{$data['detail_pendaftaran']->tempat_lahir}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Tanggal Lahir</label>
                                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($data['detail_pendaftaran']->tanggal_lahir)->format('d F Y') }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <h5 class="text-primary mt-3 mb-4 pb-2 border-bottom"><i class="fas fa-graduation-cap"></i> Data Akademik</h5>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Sekolah / Universitas</label>
                                            <input type="text" class="form-control" value="{{$data['detail_pendaftaran']->sekolah}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Jurusan</label>
                                            <input type="text" class="form-control" value="{{$data['detail_pendaftaran']->jurusan}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Program Studi</label>
                                            <input type="text" class="form-control" value="{{$data['detail_pendaftaran']->program_studi}}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Alamat Lengkap</label>
                                            <textarea class="form-control" rows="2" readonly style="resize: none;">{{$data['detail_pendaftaran']->alamat_lengkap}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="text-primary"><i class="fas fa-link"></i> Jawaban Tugas & Wawancara</h5>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6>Link Video Wawancara</h6>
                                        @if($data['detail_pendaftaran']->jawaban_wawancara)
                                            <a href="{{ $data['detail_pendaftaran']->jawaban_wawancara }}" target="_blank" class="btn btn-outline-primary btn-block">
                                                <i class="fas fa-video"></i> Buka Link Video
                                            </a>
                                            <small class="text-muted">{{ $data['detail_pendaftaran']->jawaban_wawancara }}</small>
                                        @else
                                            <p class="text-muted">Belum disubmit oleh peserta.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6>Link Project Based Test</h6>
                                        @if($data['detail_pendaftaran']->link_project)
                                            <a href="{{ $data['detail_pendaftaran']->link_project }}" target="_blank" class="btn btn-outline-info btn-block">
                                                <i class="fas fa-folder-open"></i> Buka Link Project
                                            </a>
                                            <small class="text-muted">{{ $data['detail_pendaftaran']->link_project }}</small>
                                        @else
                                            <p class="text-muted">Belum disubmit oleh peserta.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
