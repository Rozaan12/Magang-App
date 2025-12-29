<header id="header" class="fixed-top">
<div class="container d-flex">

    <div class="logo mr-auto">
        <!-- <h1 class="text-light"><a href="{{ url('')}}"><span style="color: #6a3093;">E</span>-Magang</a></h1> -->
        <a href="{{ url('')}}"><img src="{{ asset('assets_admin/img/profile_perusahaan/Logo 4 - Color Horizontal - No Background.png') }}" alt="" class="img-fluid" style="max-height: 50px;"></a>
    </div>

    <nav class="nav-menu d-none d-lg-block">
    <ul>
        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ url('') }}#about">About Us</a></li>
        <li><a href="{{ url('')}}#services">Alur</a></li>
        <li><a href="{{ url('') }}#contact">Contact Us</a></li>
        
        <?php if(Auth::user() == ''){ ?>
            <li class="{{ Request::is('login') ? 'active' : '' }}"><a href="<?= url('login')?>">Login</a></li>
          <?php }else{ ?>
            <li class="{{ Request::is('pendaftaran') ? 'active' : '' }}"><a href="{{ url('pendaftaran')}}">Lowongan Magang</a></li>
            <li class="{{ Request::is('data-lamaran') || Request::is('detail-lamaran/*') ? 'active' : '' }}"><a href="{{ url('data-lamaran')}}">Lamaran</a></li>
            <li class="drop-down {{ Request::is('profile') ? 'active' : '' }}"><a href="#">{{ Auth::user()->name}}</a>
              <ul>
                <li><a href="<?= url('profile')?>">Profile</a></li>
                <li><a href="<?= url('logout')?>">Logout</a></li>
              </ul>
            </li>
          <?php }?>
    </ul>

    </nav><!-- .nav-menu -->

</div>
</header><!-- End Header -->