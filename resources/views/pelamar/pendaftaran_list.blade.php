@extends('template.master')
@section('contents')
<style>
    .card-lowongan {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
        height: 100%;
    }
    .card-lowongan:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(106, 48, 147, 0.15);
    }
    .card-img-top {
        height: 180px;
        object-fit: cover;
        background-color: #f0f0f0;
    }
    .card-body {
        padding: 25px;
    }
    .badge-kuota {
        background-color: #e3f2fd;
        color: #0d47a1;
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: 600;
    }
    .btn-lamar {
        background-color: #6a3093;
        border: none;
        border-radius: 50px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-lamar:hover {
        background-color: #522472;
        box-shadow: 0 5px 15px rgba(106, 48, 147, 0.3);
    }
    .modal-header {
        background-color: #6a3093;
        color: white;
    }
    .modal-title {
        color: white; /* Explicitly set text color to white */
        font-weight: 600;
    }
    .close {
        color: white;
        text-shadow: none;
        opacity: 0.8;
    }
    .close:hover {
        opacity: 1;
        color: #fff;
    }
</style>

<div class="blog-page area-padding" style="padding-top: 150px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-headline text-center">
                    <h2>Daftar Lowongan Magang</h2>
                    <p class="text-muted">Pilih posisi yang sesuai dengan minat dan kualifikasi Anda.</p>
                </div>
            </div>
        </div>
        
        @if (session()->has('err_message'))
            <div class="alert alert-danger">{{ session()->get('err_message') }}</div>
        @endif

        @if($data['lamaran_aktif'])
            <div class="alert alert-warning text-center">
                <strong>Info:</strong> Anda sudah memiliki lamaran aktif. Silakan cek menu <a href="{{ url('data-lamaran') }}">Data Lamaran</a> untuk melihat status seleksi.
            </div>
        @else 
             <!-- List Lowongan -->
            <div class="row mt-4">
                @foreach($data['lowongan'] as $l)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card card-lowongan">
                        <!-- Gambar Lowongan (Placeholder jika null) -->
                        <img class="card-img-top" src="{{ $l->gambar ? asset('uploads/lowongan/'.$l->gambar) : 'https://via.placeholder.com/400x200?text='.urlencode($l->nama_lowongan) }}" alt="{{ $l->nama_lowongan }}">
                        
                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <span class="badge badge-kuota"><i class="fa fa-users"></i> Kuota: {{ $l->kuota }} Orang</span>
                            </div>
                            <h4 class="card-title text-dark font-weight-bold">{{ $l->nama_lowongan }}</h4>
                            <p class="card-text text-muted flex-grow-1">{{ Str::limit($l->deskripsi, 100) }}</p>
                            
                            <button class="btn btn-lamar mt-3 btn-detail text-white" 
                                data-toggle="modal" 
                                data-target="#modalDetail{{ $l->id }}">
                                Lihat Detail & Lamar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail Lowongan -->
                <div class="modal fade" id="modalDetail{{ $l->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content" style="border-radius: 20px;">
                            <div class="modal-header border-0 pb-0">
                                <h5 class="modal-title font-weight-bold text-white">{{ $l->nama_lowongan }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="row">
                                    <div class="col-md-5">
                                        <img src="{{ $l->gambar ? asset('uploads/lowongan/'.$l->gambar) : 'https://via.placeholder.com/400x200?text='.urlencode($l->nama_lowongan) }}" class="img-fluid rounded mb-3 shadow-sm" alt="">
                                        <div class="bg-light p-3 rounded">
                                            <small class="text-muted d-block">Minimal Durasi:</small>
                                            <h6 class="font-weight-bold">{{ $l->minimal_durasi }} Bulan</h6>
                                            <small class="text-muted d-block mt-2">Kuota Terbuka:</small>
                                            <h6 class="font-weight-bold">{{ $l->kuota }} Orang</h6>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <h5>Deskripsi Pekerjaan</h5>
                                        <p>{{ $l->deskripsi }}</p>
                                        
                                        <h5 class="mt-4">Persyaratan Kualifikasi</h5>
                                        <div class="bg-light p-3 rounded" style="font-size: 14px;">
                                            {!! nl2br(e($l->persyaratan)) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-secondary rounded-pill px-4" data-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-lamar px-4 text-white rounded-pill" data-toggle="modal" data-target="#modalLamar{{ $l->id }}" data-dismiss="modal">Lamar Sekarang</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Form Lamaran (Popup Kedua) -->
                <div class="modal fade" id="modalLamar{{ $l->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content" style="border-radius: 20px; border: none;">
                            <div class="modal-header bg-white border-0">
                                <h5 class="modal-title font-weight-bold text-dark w-100 text-center mt-3">Lengkapi Data Lamaran</h5>
                                <button type="button" class="close position-absolute" style="right: 20px;" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="text-dark">&times;</span>
                                </button>
                            </div>
                            <form action="{{ url('insert-pendaftaran') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_lowongan" value="{{ $l->id }}">
                                <div class="modal-body px-4 pb-4">
                                    <div class="alert alert-purple mb-4" style="background: #f3e5f5; color: #6a3093; border: none; border-radius: 12px; font-size: 13px;">
                                        <i class="fas fa-info-circle mr-2"></i> Posisi ini mensyaratkan durasi magang minimal <strong>{{ $l->minimal_durasi }} bulan</strong>.
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">Tanggal Mulai</label>
                                            <input type="date" name="dari_tanggal" class="form-control" required min="{{ date('Y-m-d') }}">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="font-weight-bold">Tanggal Selesai</label>
                                            <input type="date" name="sampai_tanggal" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label class="font-weight-bold">Surat Rekomendasi Magang (PDF)</label>
                                        <div class="custom-file">
                                            <input type="file" name="surat_rekomendasi" class="custom-file-input" id="fileRekom{{ $l->id }}" required accept="application/pdf">
                                            <label class="custom-file-label" for="fileRekom{{ $l->id }}">Pilih file PDF...</label>
                                        </div>
                                        <small class="text-muted">Wajib upload surat rekomendasi dari kampus/sekolah.</small>
                                    </div>

                                    <div id="durationWarning{{ $l->id }}" class="alert alert-danger mt-3 d-none" style="border-radius: 10px; font-size: 13px;">
                                        <i class="fas fa-exclamation-triangle mr-2"></i> Periode magang kurang dari kriteria minimal ({{ $l->minimal_durasi }} bulan).
                                    </div>
                                </div>
                                <div class="modal-footer border-0 px-4 pb-4">
                                    <button type="submit" id="btnSubmit{{ $l->id }}" class="btn btn-lamar btn-block text-white py-3 shadow-sm" style="border-radius: 15px; font-weight: 700; font-size: 16px;">
                                        KIRIM LAMARAN
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    document.querySelector('#modalLamar{{ $l->id }} form').addEventListener('change', function() {
                        const start = new Date(this.dari_tanggal.value);
                        const end = new Date(this.sampai_tanggal.value);
                        const minMonths = {{ $l->minimal_durasi }};
                        const warning = document.getElementById('durationWarning{{ $l->id }}');
                        const btn = document.getElementById('btnSubmit{{ $l->id }}');

                        if (this.dari_tanggal.value && this.sampai_tanggal.value) {
                            // Hitung selisih bulan secara sederhana
                            let months = (end.getFullYear() - start.getFullYear()) * 12;
                            months -= start.getMonth();
                            months += end.getMonth();
                            
                            // Hitung hari juga untuk lebih akurat (minimal 28 hari dianggap 1 bulan)
                            const diffTime = Math.abs(end - start);
                            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                            const actualMonths = diffDays / 30;

                            if (actualMonths < minMonths) {
                                warning.classList.remove('d-none');
                                btn.disabled = true;
                                btn.style.opacity = '0.5';
                            } else {
                                warning.classList.add('d-none');
                                btn.disabled = false;
                                btn.style.opacity = '1';
                            }
                        }
                    });

                    // Update filename label
                    document.getElementById('fileRekom{{ $l->id }}').addEventListener('change', function(e) {
                        var fileName = e.target.files[0].name;
                        var nextSibling = e.target.nextElementSibling;
                        nextSibling.innerText = fileName;
                    });
                </script>
                @endforeach
            </div>
        @endif


       
    </div>
</div>
@endsection
