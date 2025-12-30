<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register - Magang Sarastya</title>
  <link rel="shortcut icon" href="{{ asset('assets_admin/img/profile_perusahaan/Logo 4 - Color Horizontal - No Background.png') }}" type="image/x-icon">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('')}}assets_admin/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('')}}assets_admin/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('')}}assets_admin/modules/jquery-selectric/selectric.css">

  <!-- assets_admin CSS -->
  <link rel="stylesheet" href="{{asset('')}}assets_admin/css/style.css">
  <link rel="stylesheet" href="{{asset('')}}assets_admin/css/components.css">
  
  <style>
      body {
          background-color: #f4f6f9;
      }
      .card-primary {
          border-top: 2px solid #6a3093 !important;
      }
      .btn-primary {
          background-color: #6a3093 !important;
          border-color: #6a3093 !important;
          box-shadow: 0 2px 6px rgba(106, 48, 147, 0.4) !important;
      }
      .btn-primary:hover {
          background-color: #5e3b85 !important;
          border-color: #5e3b85 !important;
      }
      .text-primary, a {
          color: #6a3093 !important;
      }
      a:hover {
          color: #d23c99 !important;
          text-decoration: none;
      }
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
  </style>
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
                <img src="{{ asset('assets_admin/img/profile_perusahaan/Logo 4 - Color Horizontal - No Background.png') }}" alt="logo" width="350">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Form Pendaftaran Akun</h4></div>

              <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <strong>Perhatian!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session()->has('err_message'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <strong>Error! </strong>{{ session()->get('err_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                
                <form class="user" method="POST" enctype="multipart/form-data" action="{{url('insert-register')}}">
                    @csrf
                    
                    <!-- BAGIAN 1: DATA PRIBADI -->
                    <div class="section-title">Data Pribadi</div>
                    
                    <div class="form-group">
                      <label for="nama_lengkap">Nama Lengkap</label>
                      <input id="nama_lengkap" type="text" class="form-control" name="nama_lengkap" placeholder="Sesuai KTP/KTM" autofocus required>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" required>
                        </div>
                        <div class="form-group col-6">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                      <label>Alamat Domisili</label>
                      <textarea name="alamat_lengkap" required class="form-control" rows="3" style="min-height: 80px;"></textarea>
                    </div>

                    <!-- BAGIAN 2: DATA PENDIDIKAN -->
                    <div class="section-title">Data Pendidikan</div>
                    
                    <div class="form-group">
                        <label>Asal Sekolah / Universitas</label>
                        <input type="text" name="sekolah" class="form-control" placeholder="Contoh: Universitas Brawijaya" required>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label>Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" placeholder="Contoh: Teknik Informatika" required>
                        </div>
                        <div class="form-group col-6">
                            <label>Program Studi (Opsional)</label>
                            <input type="text" name="program_studi" class="form-control" placeholder="Jika ada">
                        </div>
                    </div>

                    <!-- BAGIAN 3: BERKAS LAMARAN -->
                    <div class="section-title">Berkas Lamaran</div>
                    
                    <div class="form-group">
                        <label>Curriculum Vitae (CV)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="cv" name="cv" accept=".pdf" required>
                            <label class="custom-file-label" for="cv">Pilih file PDF...</label>
                        </div>
                        <small class="form-text text-muted">Format PDF, Maksimal 2MB.</small>
                    </div>

                    <div class="form-group">
                        <label>Portofolio (Opsional)</label>
                        <p class="text-muted" style="font-size: 13px; margin-bottom: 5px;">Upload file PDF <b>ATAU</b> masukkan Link (Google Drive/Behance/Github).</p>
                        
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="portofolio_file" name="portofolio_file" accept=".pdf">
                                    <label class="custom-file-label" for="portofolio_file">File PDF...</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="url" name="portofolio_link" class="form-control" placeholder="https://...">
                            </div>
                        </div>
                    </div>

                    <!-- BAGIAN 4: AKUN LOGIN -->
                    <div class="section-title">Akun Login</div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="email">Alamat Email</label>
                            <input id="email" type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" autocomplete="new-password" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fa fa-eye" id="eyeIcon"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>No. WhatsApp</label>
                            <input type="number" name="no_telp" class="form-control" placeholder="08..." required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Username Telegram</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">@</div>
                                </div>
                                <input type="text" name="username_telegram" class="form-control" placeholder="username" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="agree" class="custom-control-input" id="agree" required>
                        <label class="custom-control-label" for="agree">Saya menyetujui syarat dan ketentuan yang berlaku.</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Daftar Sekarang
                        </button>
                    </div>
                </form>

                <div class="mt-5 text-muted text-center">
                    Sudah Punya Akun? <a href="{{url('login')}}">Login disini</a>
                </div>
                  
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Magang Sarastya 2025
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="{{asset('')}}assets_admin/modules/jquery.min.js"></script>
  <script src="{{asset('')}}assets_admin/modules/popper.js"></script>
  <script src="{{asset('')}}assets_admin/modules/tooltip.js"></script>
  <script src="{{asset('')}}assets_admin/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="{{asset('')}}assets_admin/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="{{asset('')}}assets_admin/modules/moment.min.js"></script>
  <script src="{{asset('')}}assets_admin/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="{{asset('')}}assets_admin/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="{{asset('')}}assets_admin/modules/jquery-selectric/jquery.selectric.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="{{asset('')}}assets_admin/js/page/auth-register.js"></script>

  <!-- assets_admin JS File -->
  <script src="{{asset('')}}assets_admin/js/scripts.js"></script>
  <script src="{{asset('')}}assets_admin/js/custom.js"></script>

  <script>
    $(document).ready(function() {
        $("#togglePassword").click(function() {
            const passwordField = $("#password");
            const eyeIcon = $("#eyeIcon");
            
            if (passwordField.attr("type") === "password") {
                passwordField.attr("type", "text");
                eyeIcon.removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                passwordField.attr("type", "password");
                eyeIcon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });
    });
  </script>

  <!-- Custom File Input Label Fix -->
  <script>
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
  </script>

  @if (session()->has('err_message'))
    <script>
        console.error("Laravel Error: {{ session('err_message') }}");
    </script>
  @endif
</body>
</html>
