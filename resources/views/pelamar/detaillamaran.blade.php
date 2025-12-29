@extends('template.master')
@section('contents')
<div class="blog-page area-padding" style="padding-top: 120px; padding-bottom: 60px;">
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-10">
                <div class="card shadow-lg border-0" style="border-radius: 20px; overflow: hidden;">
                    <!-- Header Card -->
                    <div class="card-header p-4 text-center" style="background: linear-gradient(135deg, #6a3093 0%, #a044ff 100%);">
                        <h3 class="mb-0 font-weight-bold text-white">Detail Status Lamaran</h3>
                    </div>

                    <div class="card-body p-5">
                        <div class="row align-items-center mb-5">
                            <div class="col-md-2 text-center">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm" style="width: 80px; height: 80px;">
                                    <i class="fas fa-briefcase fa-2x text-primary shadow-sm"></i>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <h4 class="font-weight-bold text-dark mb-1">{{ $data['detail_pendaftaran']->nama_lowongan ?? 'Magang Reguler' }}</h4>
                                <p class="text-muted mb-0"><i class="fas fa-building mr-1"></i> Sarastya Agility Innovations</p>
                            </div>
                            <div class="col-md-3 text-md-right text-center mt-3 mt-md-0">
                                @if($data['detail_pendaftaran']->status_pendaftaran == 'menunggu_verifikasi')
                                    <div class="badge badge-warning p-3 rounded shadow-sm" style="font-size: 14px; width: 100%;">
                                        <i class="fas fa-clock mr-1"></i> Menunggu Verifikasi
                                    </div>
                                @elseif($data['detail_pendaftaran']->status_pendaftaran == 'diterima')
                                    <div class="badge badge-success p-3 rounded shadow-sm" style="font-size: 14px; width: 100%;">
                                        <i class="fas fa-check-circle mr-1"></i> Diterima
                                    </div>
                                @elseif($data['detail_pendaftaran']->status_pendaftaran == 'tidak diterima')
                                    <div class="badge badge-danger p-3 rounded shadow-sm" style="font-size: 14px; width: 100%;">
                                        <i class="fas fa-times-circle mr-1"></i> Tidak Diterima
                                    </div>
                                @endif
                            </div>
                        </div>

                        <hr class="my-5 shadow-sm">

                        <!-- Main Content -->
                        <div class="row">
                            <!-- Left: Status & Info -->
                            <div class="col-md-7 border-right shadow-sm">
                                <h5 class="font-weight-bold text-dark mb-4 mt-3"><i class="fas fa-info-circle mr-2 text-primary shadow-sm"></i>Informasi Terbaru</h5>
                                
                                @if($data['detail_pendaftaran']->status_pendaftaran == 'menunggu_verifikasi')
                                    <div class="alert alert-info border-0 shadow-sm" style="background-color: #f0f7ff; border-radius: 12px; padding: 20px;">
                                        <p class="mb-0 text-dark" style="line-height: 1.6;">
                                            Terima kasih sudah melamar! Saat ini tim HR kami sedang melakukan review berkas administratif Anda. Hasil seleksi akan kami umumkan maksimal 7 hari kerja. Mohon pantau halaman ini secara berkala.
                                        </p>
                                    </div>
                                @elseif($data['detail_pendaftaran']->status_pendaftaran == 'diterima')
                                    @if (session()->has('suc_message'))
                                        <div class="alert alert-success alert-dismissible fade show border-0 mb-4 shadow-sm" role="alert" style="border-radius: 12px;">
                                            <i class="fas fa-check-circle mr-2"></i> {{ session()->get('suc_message') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    @if (session()->has('err_message'))
                                        <div class="alert alert-danger alert-dismissible fade show border-0 mb-4 shadow-sm" role="alert" style="border-radius: 12px;">
                                            <i class="fas fa-exclamation-triangle mr-2"></i> {{ session()->get('err_message') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <div class="p-4 bg-light rounded shadow-sm" style="border-radius: 12px; border-left: 5px solid #28a745;">
                                        <h6 class="font-weight-bold text-success mb-2">Pesan Dari Tim HR:</h6>
                                        <div class="text-dark bg-white p-3 rounded" style="font-style: italic; font-size: 15px;">
                                            @if($data['detail_pendaftaran']->keterangan)
                                                {!! nl2br(e($data['detail_pendaftaran']->keterangan)) !!}
                                            @else
                                                Selamat! Anda dinyatakan lolos seleksi administratif. Silakan ikuti instruksi selanjutnya di bawah ini.
                                            @endif
                                        </div>

                                        <div class="mt-4">
                                            <h6 class="font-weight-bold mb-3 mt-3 shadow-sm text-primary">Instruksi Pengerjaan & Wawancara:</h6>
                                            
                                            @if($data['detail_pendaftaran']->file_tugas)
                                                <div class="alert alert-warning border-0 shadow-sm" style="border-radius: 12px;">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-8">
                                                            <p class="mb-0 font-weight-bold"><i class="fas fa-file-pdf mr-2"></i> File Pertanyaan & Tugas</p>
                                                            <small class="text-muted">Silakan download file ini untuk melihat daftar pertanyaan wawancara dan instruksi project.</small>
                                                        </div>
                                                        <div class="col-md-4 text-md-right mt-3 mt-md-0">
                                                            <a href="{{ asset('uploads/file_tugas/' . $data['detail_pendaftaran']->file_tugas) }}" class="btn btn-primary btn-sm px-3 shadow-sm" target="_blank">
                                                                 <i class="fas fa-download mr-1"></i> Download PDF
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="bg-white p-4 rounded border shadow-sm">
                                                    @if($data['detail_pendaftaran']->pertanyaan_wawancara)
                                                        <div class="mb-4">
                                                            <p class="mb-2 font-weight-bold text-primary"><i class="fas fa-question-circle mr-1 shadow-sm"></i> Pertanyaan Wawancara:</p>
                                                            <div class="bg-light p-3 rounded">
                                                                {!! nl2br(e($data['detail_pendaftaran']->pertanyaan_wawancara)) !!}
                                                            </div>
                                                        </div>
                                                    @endif
                                                    
                                                    @if($data['detail_pendaftaran']->tugas_project)
                                                        <div class="mb-2">
                                                            <p class="mb-2 font-weight-bold text-primary"><i class="fas fa-tasks mr-1 shadow-sm"></i> Tugas Project:</p>
                                                            <div class="bg-light p-3 rounded">
                                                                {!! nl2br(e($data['detail_pendaftaran']->tugas_project)) !!}
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if(!$data['detail_pendaftaran']->pertanyaan_wawancara && !$data['detail_pendaftaran']->tugas_project)
                                                        <p class="text-muted italic">Tidak ada instruksi khusus yang dilampirkan. Mohon tunggu informasi lebih lanjut dari HR.</p>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Form Input Link Tugas -->
                                        <form action="{{ url('submit-links') }}" method="POST" class="mt-4 p-4 border rounded bg-white shadow-sm" style="border-radius: 12px;">
                                            @csrf
                                            <input type="hidden" name="id_pendaftaran" value="{{ $data['detail_pendaftaran']->id_pendaftaran }}">
                                            <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-paper-plane mr-1"></i> Submit Jawaban Tugas & Wawancara</h6>
                                            
                                            <div class="form-group mb-3">
                                                <label class="font-weight-bold text-dark" style="font-size: 14px;">Link Video Wawancara</label>
                                                <input type="url" name="jawaban_wawancara" class="form-control" placeholder="Contoh: https://youtube.com/watch?v=..." value="{{ $data['detail_pendaftaran']->jawaban_wawancara }}" required>
                                                <small class="text-muted italic">Masukkan link video (YouTube/Google Drive/Lainnya).</small>
                                            </div>

                                            <div class="form-group mb-4">
                                                <label class="font-weight-bold text-dark" style="font-size: 14px;">Link Google Drive Project Based Test</label>
                                                <input type="url" name="link_project" class="form-control" placeholder="Contoh: https://drive.google.com/drive/folders/..." value="{{ $data['detail_pendaftaran']->link_project }}" required>
                                                <small class="text-muted italic">Pastikan link dapat diakses (Public/Anyone with link) oleh tim HR kami.</small>
                                            </div>

                                            <button type="submit" class="btn btn-success btn-block shadow-sm py-2 font-weight-bold">
                                                <i class="fas fa-save mr-1"></i> Simpan Jawaban Lamaran
                                            </button>
                                        </form>
                                    </div>
                                @elseif($data['detail_pendaftaran']->status_pendaftaran == 'tidak diterima')
                                    <div class="alert alert-danger border-0 shadow-sm" style="background-color: #fff5f5; border-radius: 12px; padding: 20px;">
                                        <h6 class="font-weight-bold mb-2">Keputusan HR:</h6>
                                        <p class="mb-0 text-dark">
                                            {{ $data['detail_pendaftaran']->keterangan ?? 'Mohon maaf, profil Anda belum sesuai dengan kebutuhan kami saat ini. Tetap semangat dan coba lagi di kesempatan berikutnya!' }}
                                        </p>
                                    </div>
                                @endif
                            </div>

                            <!-- Right: Your Data Profile -->
                            <div class="col-md-5">
                                <div class="pl-md-4 mt-4 mt-md-0 shadow-sm">
                                    <h5 class="font-weight-bold text-dark mb-4 mt-3"><i class="fas fa-user-circle mr-2 text-primary shadow-sm"></i>Data Pribadi Anda</h5>
                                    <div class="list-group list-group-flush shadow-sm">
                                        <div class="list-group-item px-3 py-3 border-0 shadow-sm mb-2" style="background: #fdfdfd; border-radius: 8px;">
                                            <small class="text-muted d-block">Nama Lengkap</small>
                                            <span class="font-weight-bold">{{ $data['detail_pendaftaran']->nama_lengkap }}</span>
                                        </div>
                                        <div class="list-group-item px-3 py-3 border-0 shadow-sm mb-2" style="background: #fdfdfd; border-radius: 8px;">
                                            <small class="text-muted d-block">Sekolah / Perguruan Tinggi</small>
                                            <span class="font-weight-bold text-dark">{{ $data['detail_pendaftaran']->sekolah ?? '-' }}</span>
                                        </div>
                                        <div class="list-group-item px-3 py-3 border-0 shadow-sm mb-2" style="background: #fdfdfd; border-radius: 8px;">
                                            <small class="text-muted d-block">Jurusan / Program Studi</small>
                                            <span class="font-weight-bold text-dark">{{ $data['detail_pendaftaran']->jurusan ?? '-' }}</span>
                                        </div>

                                    </div>

                                    <div class="mt-4 pt-4 border-top">
                                        <a href="{{ url('data-lamaran') }}" class="btn btn-secondary btn-block shadow-sm mb-4">
                                            <i class="fas fa-arrow-left mr-1 shadow-sm"></i> Kembali ke Daftar
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .opacity-8 { opacity: 0.8; }
    .list-group-item span { font-size: 15px; }
</style>
@endsection