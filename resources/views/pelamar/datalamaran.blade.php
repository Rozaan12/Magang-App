@extends('template.master')
@section('contents')
<div class="blog-page area-padding" style="padding-top: 120px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-headline text-center">
                    <h2>Status Lamaran Magang</h2>
                    <p class="text-muted">Pantau tahapan seleksi lamaran Anda di sini secara berkala.</p>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                @if (session()->has('err_message'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        {{ session()->get('err_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('suc_message'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ session()->get('suc_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card shadow-sm border-0" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th>Posisi Lowongan</th>
                                        <th>Tanggal Melamar</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data['data_lamaran'] as $index => $item)
                                        <tr>
                                            <td class="text-center font-weight-bold">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-posisi mr-3 text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #6a3093; border_radius: 8px;">
                                                        <i class="fas fa-briefcase"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 font-weight-bold text-dark">{{ $item->nama_lowongan ?? 'Magang Reguler' }}</h6>
                                                        <small class="text-muted">Sarastya Agility Innovations</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <i class="far fa-calendar-alt text-muted mr-1"></i>
                                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                            </td>
                                            <td class="text-center">
                                                @if($item->status_pendaftaran == 'menunggu_verifikasi')
                                                    <span class="badge badge-pill badge-warning px-3 py-2" style="font-size: 11px;">
                                                        <i class="fas fa-clock mr-1"></i> Menunggu Verifikasi
                                                    </span>
                                                @elseif($item->status_pendaftaran == 'diterima')
                                                    <span class="badge badge-pill badge-success px-3 py-2" style="font-size: 11px;">
                                                        <i class="fas fa-check-circle mr-1"></i> Diterima
                                                    </span>
                                                @elseif($item->status_pendaftaran == 'tidak diterima')
                                                    <span class="badge badge-pill badge-danger px-3 py-2" style="font-size: 11px;">
                                                        <i class="fas fa-times-circle mr-1"></i> Tidak Diterima
                                                    </span>
                                                @else
                                                    <span class="badge badge-pill badge-secondary px-3 py-2" style="font-size: 11px;">
                                                        {{ strtoupper($item->status_pendaftaran) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ url('detail-lamaran/' . $item->id_pendaftaran) }}" class="btn btn-sm btn-outline-primary px-3">
                                                    <i class="fas fa-search-plus mr-1"></i> Lihat Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                                                Belum ada lamaran yang diajukan.<br>
                                                <a href="{{ url('pendaftaran') }}" class="btn btn-primary mt-3">Cari Lowongan</a>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Info Section -->
                <div class="mt-5 p-4 bg-light shadow-sm" style="border-radius: 15px; border-left: 5px solid #6a3093;">
                    <h5 class="font-weight-bold text-dark"><i class="fas fa-info-circle mr-2"></i>Informasi Tahapan Pendaftaran</h5>
                    <ul class="mt-3 text-muted" style="line-height: 1.8;">
                        <li><strong>Menunggu Verifikasi:</strong> Berkas lamaran Anda sedang dalam tahap review oleh tim HR kami.</li>
                        <li><strong>Diterima:</strong> Selamat! Anda lolos seleksi berkas. Silakan cek detail untuk instruksi wawancara/test selanjutnya.</li>
                        <li><strong>Tidak Diterima:</strong> Mohon maaf, saat ini profil Anda belum sesuai dengan kebutuhan posisi tersebut.</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .icon-posisi {
        border-radius: 8px;
    }
    .table thead th {
        border-top: none;
        color: #6a3093;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
    }
    .badge-pill {
        font-weight: 500;
    }
</style>
@endsection