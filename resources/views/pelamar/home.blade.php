 
@extends('template.master')
@section('contents')
 <!-- ======= Slider Section ======= -->
 
 <div id="home" class="slider-area">
    <div class="bend niceties preview-2">
      <div id="ensign-nivoslider" class="slides">
        <img src="{{ asset('assets') }}/img/slider/Depan.jpg" alt="" title="#slider-direction-1" />
        <img src="{{ asset('assets') }}/img/slider/Gedung.jpg" alt="" title="#slider-direction-2" />
        <img src="{{ asset('assets') }}/img/slider/Rooftop.jpg" alt="" title="#slider-direction-3" />
      </div>

      <!-- direction 1 -->
      <div id="slider-direction-1" class="slider-direction slider-one">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow animate__slideInDown animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1">Sarastya Agility Innovations </h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow animate__fadeIn animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                  <h1 class="title2">Selamat Datang di Sarastya Agility Innovations</h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow animate__slideInUp animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                  <a class="ready-btn right-btn page-scroll" href="{{ url('registrasi') }}">Daftar Sekarang</a>
                  <a class="ready-btn page-scroll" href="#contact">Contact us</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- direction 2 -->
      <div id="slider-direction-2" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content text-center">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow animate__slideInUp animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1"></h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow animate__fadeIn animate__animated" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">Membuka Lowongan Magang</h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow animate__slideInUp animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                  <a class="ready-btn right-btn page-scroll" href="{{ url('registrasi') }}">Daftar Sekarang</a>
                  <a class="ready-btn page-scroll" href="#contact">Contact us</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- direction 3 -->
      <div id="slider-direction-3" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow animate__slideInUp animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1">Ikuti Petunjuk Yang Ada </h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow animate__fadeIn animate__animated" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">Lebih Cepat, Lebih baik dan Bisa Mendaftar Dirumah</h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow animate__slideInUp animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                    <a class="ready-btn right-btn page-scroll" href="{{ url('registrasi') }}">Daftar Sekarang</a>
                    <a class="ready-btn page-scroll" href="#contact">Contact us</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- End Slider -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <div id="about" class="about-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Tentang Kami</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- single-well start-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="well-left">
              <div class="single-well">
                <a href="#">
                  <img src="{{ asset('assets_admin/img/profile_perusahaan/Logo 4 - Color Horizontal - No Background.png') }}" alt="" style="width: 100%; max-width: 500px;">
                </a>
              </div>
            </div>
          </div>
          <!-- single-well end-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="well-middle">
              <div class="single-well">
                <a href="#">
                  <h4 class="sec-head">Profile Perusahaan</h4>
                </a>
                <p>
                  Sarastya Agility Innovations adalah perusahaan yang bergerak di bidang teknologi dan inovasi digital. Kami menyediakan kesempatan bagi para mahasiswa dan pelajar untuk mengembangkan potensi diri melalui program magang yang terstruktur dan profesional.
                </p>
                <p>
                   Bergabunglah bersama kami untuk menciptakan solusi masa depan dan mengasah skill di dunia industri yang sesungguhnya.
                </p>
                <ul>
                    <li><i class="fa fa-check"></i> Lingkungan kerja profesional</li>
                    <li><i class="fa fa-check"></i> Mentor berpengalaman</li>
                    <li><i class="fa fa-check"></i> Proyek nyata dan berdampak</li>
                </ul>
              </div>
            </div>
          </div>
          <!-- End col-->
        </div>
      </div>
    </div><!-- End About Section -->

    <!-- ======= Services Section (Alur) ======= -->
    <div id="services" class="services-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline services-head text-center">
              <h2>Alur Proses Pendaftaran</h2>
            </div>
          </div>
        </div>
        <div class="row text-center">
          @foreach($data['alur'] as $index => $a)
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="#">
                    @php
                      $icons = ['fa-user-plus', 'fa-file-text', 'fa-check-square-o', 'fa-hourglass-half', 'fa-users', 'fa-briefcase'];
                      $icon = $icons[$index % count($icons)];
                    @endphp
                    <i class="fa {{ $icon }} fa-3x" style="color:#6a3093;"></i>
                  </a>
                  <h4>{{ $a->judul }}</h4>
                  <p>
                    {{ $a->deskripsi }}
                  </p>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div><!-- End Services Section -->

    <!-- ======= Portfolio Section (Galeri) ======= -->
    <div id="portfolio" class="portfolio-area area-padding fix">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Galeri Kegiatan</h2>
            </div>
          </div>
        </div>
  
        <div class="row awesome-project-content">
          <!-- Galeri Item 1 -->
          <div class="col-md-4 col-sm-4 col-xs-12 design development">
            <div class="single-awesome-project">
              <div class="awesome-img">
                <a href="#"><img src="{{ asset('assets/img/slider/Depan.jpg') }}" alt="" style ="width:500px; height :300px; object-fit: cover;"/></a>
                <div class="add-actions text-center">
                  <div class="project-dec">
                    <a class="venobox" data-gall="myGallery" href="{{ asset('assets/img/slider/Depan.jpg') }}">
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Galeri Item 2 -->
          <div class="col-md-4 col-sm-4 col-xs-12 design development">
            <div class="single-awesome-project">
              <div class="awesome-img">
                <a href="#"><img src="{{ asset('assets/img/slider/Gedung.jpg') }}" alt="" style ="width:500px; height :300px; object-fit: cover;"/></a>
                <div class="add-actions text-center">
                  <div class="project-dec">
                    <a class="venobox" data-gall="myGallery" href="{{ asset('assets/img/slider/Gedung.jpg') }}">
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Galeri Item 3 -->
          <div class="col-md-4 col-sm-4 col-xs-12 design development">
            <div class="single-awesome-project">
              <div class="awesome-img">
                <a href="#"><img src="{{ asset('assets/img/slider/Rooftop.jpg') }}" alt="" style ="width:500px; height :300px; object-fit: cover;"/></a>
                <div class="add-actions text-center">
                  <div class="project-dec">
                    <a class="venobox" data-gall="myGallery" href="{{ asset('assets/img/slider/Rooftop.jpg') }}">
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div><!-- End Portfolio Section -->

    <div id="contact" class="contact-area">
      <div class="contact-inner area-padding">
        <div class="contact-overly"></div>
        <div class="container ">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Kontak kami</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- Start contact icon column -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="fa fa-mobile"></i>
                  <p>
                    WhatsApp <br>
                    <span>+62 851-1773-5117</span>
                  </p>
                </div>
              </div>
            </div>
            <!-- Start contact icon column -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="fa fa-envelope-o"></i>
                  <p>
                    Email: sarastya.hg@gmail.com<br>
                    <span>Instagram: @sarastya.agility</span>
                  </p>
                </div>
              </div>
            </div>
            <!-- Start contact icon column -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="fa fa-map-marker"></i>
                  <p>
                    Alamat Kantor<br>
                    <span>Jl. Trs.Candi Mendut No.9B, Mojolangu, Kec. Lowokwaru, Kota Malang, Jawa Timur 65142</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Contact Section -->

  </main><!-- End #main -->
  @endsection