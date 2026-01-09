@extends('template.master')
@section('contents')
<style>
      .section-title {
          font-size: 16px;
          font-weight: 600;
          color: #6a3093;
          margin-bottom: 15px;
          border-bottom: 1px solid #eee;
          padding-bottom: 5px;
          margin-top: 20px;
      }
      .section-title:first-child {
          margin-top: 0;
      }
      .btn-primary {
          background-color: #6a3093;
          border-color: #6a3093;
      }
      .btn-primary:hover {
          background-color: #5e3b85;
          border-color: #5e3b85;
      }
      .file-link {
          display: inline-block;
          margin-top: 5px;
          color: #6a3093;
          font-weight: 500;
      }
      .file-link i {
          margin-right: 5px;
      }
</style>

<div class="blog-page area-padding">
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <div class="text-center"><h2>Profil Saya</h2></div>
                <p class="text-center text-muted">Kelola data diri dan berkas lamaran magang Anda.</p>
                <hr>

                <form method="POST" action="{{url('update-profile-users')}}" enctype="multipart/form-data">
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
                    @csrf
                    
                    <!-- DATA PRIBADI -->
                    <div class="section-title">Data Pribadi</div>
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input id="nama_lengkap" type="text" class="form-control" name="nama_lengkap" required value="{{$data['profile']->nama_lengkap}}">
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" required value="{{$data['profile']->tempat_lahir}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" required value="{{$data['profile']->tanggal_lahir}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Alamat Domisili</label>
                        <textarea name="alamat_lengkap" required class="form-control" rows="3">{{$data['profile']->alamat_lengkap}}</textarea>
                    </div>

                    <!-- DATA PENDIDIKAN -->
                    <div class="section-title">Data Pendidikan</div>
                    <div class="form-group">
                        <label>Asal Sekolah / Universitas</label>
                        <input type="text" name="sekolah" class="form-control" required value="{{$data['profile']->sekolah}}">
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" required value="{{$data['profile']->jurusan}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Program Studi</label>
                            <input type="text" name="program_studi" class="form-control" value="{{$data['profile']->program_studi}}">
                        </div>
                    </div>

                    <!-- BERKAS LAMARAN -->
                    <div class="section-title">Berkas Lamaran</div>
                    <div class="row">
                        <div class="col-md-6">
                             <div class="form-group">
                                <label>Curriculum Vitae (CV)</label>
                                @if($data['profile']->cv)
                                    <div>
                                        <a href="{{ asset('berkas/' . $data['profile']->cv) }}" target="_blank" class="file-link">
                                            <i class="fa fa-file-pdf-o"></i> Lihat CV Saat Ini
                                        </a>
                                    </div>
                                @else
                                    <div class="text-danger small">Belum upload CV</div>
                                @endif
                                <div class="mt-2">
                                    <label class="small text-muted">Update CV (PDF, Maksimal 10MB. Biarkan kosong jika tidak ingin mengubah)</label>
                                    <input type="file" name="cv" class="form-control-file" accept=".pdf">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Portofolio</label>
                                @if($data['profile']->portofolio_file)
                                    <div>
                                        <a href="{{ asset('berkas/' . $data['profile']->portofolio_file) }}" target="_blank" class="file-link">
                                            <i class="fa fa-file-pdf-o"></i> Lihat Portofolio File
                                        </a>
                                    </div>
                                @endif
                                @if($data['profile']->portofolio_link)
                                     <div class="mt-1">
                                        <a href="{{ $data['profile']->portofolio_link }}" target="_blank" class="file-link">
                                            <i class="fa fa-link"></i> Kunjungi Link Portofolio
                                        </a>
                                    </div>
                                @endif
                                
                                <div class="mt-2">
                                    <label class="small text-muted">Update File Portofolio (PDF, Maksimal 10MB. Opsional)</label>
                                    <input type="file" name="portofolio_file" class="form-control-file" accept=".pdf">
                                </div>
                                <div class="mt-2">
                                    <label class="small text-muted">Link Portofolio (Opsional)</label>
                                    <input type="url" name="portofolio_link" class="form-control" value="{{$data['profile']->portofolio_link}}" placeholder="https://...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- AKUN LOGIN -->
                    <div class="section-title">Akun Login</div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required value="{{$data['profile']->email}}">
                        </div>
                        <div class="form-group col-md-6">
                             <label>Password Baru <span class="text-muted font-weight-normal">(Isi HANYA jika ganti)</span></label>
                             <input type="password" name="password" class="form-control" placeholder="******">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>No. WhatsApp</label>
                            <input type="number" name="no_telp" class="form-control" required value="{{$data['profile']->no_telp}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Username Telegram</label>
                             <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">@</div>
                                </div>
                                <input type="text" name="username_telegram" class="form-control" required value="{{$data['profile']->username_telegram ?? ''}}">
                            </div>
                        </div>
                    </div>

                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection