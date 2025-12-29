@extends('template_admin.master')
@section('contents')

<section class="section">
    <div class="section-header">
        <h1>{{$data['title']}}</h1>
    </div>

    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-plus"></i> Tambah Lowongan
    </button>

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
                <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lowongan</th>
                            <th>Kuota</th>
                            <th>Status</th>
                            <th>Gambar</th>
                            <th class="text-center" width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['data_lowongan'] as $index => $value)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $value->nama_lowongan }}</td>
                            <td>{{ $value->kuota }}</td>
                            <td>
                                @if($value->status == 'aktif')
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-danger">Tutup</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($value->gambar)
                                    <img src="{{ asset('uploads/lowongan/' . $value->gambar) }}" alt="" width="100px">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td class="text-center"> 
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updatedata{{ $value->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="{{ url('delete-lowongan/' . $value->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tambah -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Lowongan Magang</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('insert-lowongan') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Nama Lowongan / Unit Bisnis</label>
                            <input type="text" name="nama_lowongan" class="form-control" placeholder="Contoh: Divisi IT (Programmer)" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Kuota</label>
                            <input type="number" name="kuota" class="form-control" value="0" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Min. Durasi (Bulan)</label>
                            <input type="number" name="minimal_durasi" class="form-control" value="1" min="1" required>
                            <small class="text-muted">Contoh: 3</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="aktif">Aktif (Ditampilkan)</option>
                            <option value="tutup">Tutup (Disembunyikan)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Umum</label>
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan peran ini..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Persyaratan (Gunakan baris baru untuk list)</label>
                        <textarea name="persyaratan" class="form-control" rows="5" placeholder="- Syarat 1&#10;- Syarat 2"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tahapan Seleksi</label>
                        <input type="text" name="tahapan_seleksi" class="form-control" placeholder="Contoh: Administrasi -> Wawancara -> Test">
                    </div>
                    <hr>
                    <hr>
                    <div class="section-title mt-0 text-primary">Detail Pertanyaan & Tugas Magang</div>
                    <div class="form-group">
                        <label>Upload File Pertanyaan & Tugas (PDF)</label>
                        <input type="file" name="file_tugas" class="form-control" accept="application/pdf">
                        <small class="text-muted">Upload file PDF yang berisi daftar pertanyaan wawancara dan instruksi tugas project.</small>
                    </div>
                    <div class="form-group">
                        <label>Gambar Ilustrasi Lowongan</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan Lowongan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Update -->
@foreach ($data['data_lowongan'] as $value)
<div class="modal fade" id="updatedata{{ $value->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Data Lowongan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('update-lowongan') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $value->id }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Nama Lowongan / Unit Bisnis</label>
                            <input type="text" name="nama_lowongan" class="form-control" value="{{ $value->nama_lowongan }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Kuota</label>
                            <input type="number" name="kuota" class="form-control" value="{{ $value->kuota }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Min. Durasi (Bulan)</label>
                            <input type="number" name="minimal_durasi" class="form-control" value="{{ $value->minimal_durasi }}" min="1" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="aktif" {{ $value->status == 'aktif' ? 'selected' : '' }}>Aktif (Ditampilkan)</option>
                            <option value="tutup" {{ $value->status == 'tutup' ? 'selected' : '' }}>Tutup (Disembunyikan)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Umum</label>
                        <textarea name="deskripsi" class="form-control" rows="3">{{ $value->deskripsi }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Persyaratan</label>
                        <textarea name="persyaratan" class="form-control" rows="5">{{ $value->persyaratan }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Tahapan Seleksi</label>
                        <input type="text" name="tahapan_seleksi" class="form-control" value="{{ $value->tahapan_seleksi }}">
                    </div>
                    <hr>
                    <div class="section-title mt-0 text-primary">Detail Pertanyaan & Tugas Magang</div>
                    <div class="form-group">
                        <label>File Pertanyaan & Tugas Baru (PDF)</label>
                        <input type="file" name="file_tugas" class="form-control" accept="application/pdf">
                        @if($value->file_tugas)
                            <div class="mt-2">
                                <a href="{{ asset('uploads/file_tugas/' . $value->file_tugas) }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-file-pdf"></i> Lihat File Saat Ini
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Gambar Baru (Kosongkan jika tidak ganti)</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
