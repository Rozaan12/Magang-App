@extends('template_admin.master')
@section('contents')

<section class="section">
    <div class="section-header">
        <h1>{{$data['title']}}</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('suc_message'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <strong>Success! </strong>{{ session()->get('suc_message') }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <!-- DATA AKADEMIK & BERKAS -->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header"><h4>Berkas & Akademik</h4></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Sekolah/Universitas</label>
                            <input type="text" class="form-control" value="{{ $data['detail_pendaftaran']->sekolah }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <input type="text" class="form-control" value="{{ $data['detail_pendaftaran']->jurusan }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Program Studi</label>
                            <input type="text" class="form-control" value="{{ $data['detail_pendaftaran']->program_studi }}" readonly>
                        </div>
                        <hr>
                        <h6>Periode Magang & Rekomendasi</h6>
                        <div class="row mb-3">
                            <div class="col-6">
                                <small class="text-muted d-block">Mulai:</small>
                                <strong>{{ \Carbon\Carbon::parse($data['detail_pendaftaran']->dari_tanggal)->format('d/m/Y') }}</strong>
                            </div>
                            <div class="col-6 text-right">
                                <small class="text-muted d-block">Selesai:</small>
                                <strong>{{ \Carbon\Carbon::parse($data['detail_pendaftaran']->sampai_tanggal)->format('d/m/Y') }}</strong>
                            </div>
                        </div>

                        @if($data['detail_pendaftaran']->surat_rekomendasi)
                            <a href="{{ url('uploads/berkas_magang/'.$data['detail_pendaftaran']->surat_rekomendasi)}}" target="_blank" class="btn btn-primary btn-block mb-3">
                                <i class="fa fa-file-pdf"></i> Lihat Surat Rekomendasi
                            </a>
                        @endif

                        <hr>
                        <h6>Download Berkas Pribadi</h6>
                        @if($data['detail_pendaftaran']->cv)
                            <a href="{{ url('berkas/'.$data['detail_pendaftaran']->cv)}}" target="_blank" class="btn btn-warning btn-block mb-2 text-dark">
                                <i class="fa fa-file-pdf"></i> Lihat/Download CV
                            </a>
                        @endif

                        @if($data['detail_pendaftaran']->portofolio_file)
                            <a href="{{ url('berkas/'.$data['detail_pendaftaran']->portofolio_file)}}" target="_blank" class="btn btn-info btn-block mb-2">
                                <i class="fa fa-file-pdf"></i> Lihat/Download Portofolio
                            </a>
                        @endif

                        @if($data['detail_pendaftaran']->portofolio_link)
                            <a href="{{ $data['detail_pendaftaran']->portofolio_link }}" target="_blank" class="btn btn-outline-primary btn-block">
                                <i class="fa fa-link"></i> Buka Link Portofolio
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- DATA PRIBADI & POSISI -->
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Posisi Dilamar: {{ $data['detail_pendaftaran']->nama_lowongan ?? 'Magang Reguler' }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control" value="{{ $data['detail_pendaftaran']->nama_lengkap }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" value="{{ $data['detail_pendaftaran']->email }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No. WhatsApp</label>
                                    <input type="text" class="form-control" value="{{ $data['detail_pendaftaran']->no_telp }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username Telegram</label>
                                    <input type="text" class="form-control" value="{{ $data['detail_pendaftaran']->username_telegram ?? '-' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tgl Lahir</label>
                                    <input type="text" class="form-control" value="{{ $data['detail_pendaftaran']->tempat_lahir }}, {{ \Carbon\Carbon::parse($data['detail_pendaftaran']->tanggal_lahir)->format('d F Y') }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Alamat Domisili</label>
                                    <textarea class="form-control" rows="3" readonly>{{ $data['detail_pendaftaran']->alamat_lengkap }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="text-right mt-4">
                            <button type="button" class="btn btn-secondary mr-2" onclick="window.history.back()">Kembali</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#TidakDiterima">
                                Tolak Lamaran
                            </button>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Diterima">
                                Terima & Lanjut Wawancara
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tolak -->
<div class="modal fade" id="TidakDiterima">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Penolakan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{url('update-tidak-diterima')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_pendaftaran" value="{{$data['detail_pendaftaran']->id_pendaftaran}}">
                    <div class="form-group">
                        <label>Alasan Penolakan (Akan dikirim ke email user)</label>
                        <textarea name="keterangan" class="form-control" rows="4" required placeholder="Contoh: Mohon maaf, kualifikasi Anda belum sesuai dengan kebutuhan kami saat ini."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Kirim Penolakan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Terima -->
<div class="modal fade" id="Diterima">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Penerimaan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{url('update-diterima')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_pendaftaran" value="{{$data['detail_pendaftaran']->id_pendaftaran}}">
                    <div class="form-group">
                        <label>Pesan Tambahan (Instruksi Wawancara/Lainnya)</label>
                        <textarea name="keterangan" class="form-control" rows="4" placeholder="Contoh: Selamat! Anda lolos tahap administrasi. Langkah selanjutnya adalah wawancara..."></textarea>
                    </div>
                    <p class="text-muted"><small>* Status akan berubah menjadi 'Diterima' dan notifikasi email akan dikirim.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Terima Pelamar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
