@extends('layouts.mdb')
@section('content')
<!--Navigation & Intro-->
  <header>
    <!--Navbar-->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar" style="background: #1C2A48 !important;">
      <div class="container">
        <a class="navbar-brand" href="#">
          <strong>Invetory</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!--Links-->
          <ul class="navbar-nav mr-auto smooth-scroll">
            <li class="nav-item">
              <a class="nav-link" href="#home">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about" data-offset="100">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#courses" data-offset="100">Kompetensi Keahlian</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="modal" data-target="#modal-contact">Contact</a>
            </li>
          </ul>

          <!--Social Icons-->
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
              <a class="nav-link">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link">
                <i class="fab fa-instagram"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!--Navbar-->

    <!-- Intro Section -->
    <div id="home" class="view jarallax" data-jarallax='{"speed": 0.2}'
      style="background-image: url('{{url('mdb/img/96.jpeg')}}'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
      <div class="mask rgba-black-strong">
        <div class="container h-100 d-flex justify-content-center align-items-center">
          <div class="row smooth-scroll">
            <div class="col-md-12 white-text text-center">
              <div class="wow fadeInDown" data-wow-delay="0.2s">
                <h2 class="display-3 font-weight-bold mb-2">Inventory SMKN 1 Padaherang</h2>
                <hr class="hr-light">
                <h3 class="subtext-header mt-4 mb-5">Aplikasi Inventarisir SMKN 1 Padaherang.</h3>
              </div>
              @if (Route::has('login'))
                @auth
                <a  data-offset="100" class="btn btn-info wow fadeInLeft" data-wow-delay="0.2s" href="{{ url('/home') }}">Home</a>
                @else
                <a href="{{ route('login') }}" data-offset="100" class="btn btn-info wow fadeInLeft" data-wow-delay="0.2s">Login</a>
                @if (Route::has('register'))
                <a href="#" data-offset="100" class="btn btn-warning wow fadeInRight"
                data-wow-delay="0.2s" id="register" onClick="Swal.fire('Daftar ke Operator')">Daftar</a>
                {{-- <a class="btn btn-white  btn-lg orange-text font-weight-bold ml-lg-0" href="{{ route('register') }}">Daftar</a> --}}
                @endif
                {{-- <a class="btn blue-gradient  btn-lg font-weight-bold" href="{{ route('login.admin') }}">Admin</a> --}}
                @endauth
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
<!--Navigation & Intro-->
<!--Main content-->
<main>

  <div class="container">

    <!--Section: About-->
    <section id="about" class="mt-4 mb-2">

      <!--Secion heading-->
      <h2 class="text-center my-5 font-weight-bold wow fadeIn" data-wow-delay="0.2s">About SMKN 1 padaherang</h2>

      <!--First row-->
      <div class="row">

        <!--First column-->
        <div class="col-lg-5 col-md-12 mb-5 pb-4 wow fadeIn" data-wow-delay="0.4s">

          <!--Image-->
          <img src="{{url('mdb/img/94.png')}}"
            class="img-fluid z-depth-1 rounded" alt="My photo">

        </div>
        <!--First column-->

        <!--Second column-->
        <div class="col-lg-6 dark-grey-text ml-lg-auto col-md-12 wow fadeIn" data-wow-delay="0.4s">

          <!--Description-->
          <p align="justify"><i><b>Assalamu’alaikum Wr. Wb.</b></i></p>
          <p align="justify">Segala puji dan syukur kita panjatkan kehadirat Alloh SWT, semoga kita 
            semua ada dalam lindungan-Nya. dan atas perkenan-Nya pula kami dapat membuat website 
            SMK Negeri 1 Padaherang. Seiring dengan perkembangan era Teknologi Komunikasi dan Informasi 
            yang sedang kita alami, menuntut terciptanya Sumber Daya Manusia yang handal dan mempunyai 
            kemampuan sejalan dengan kemajuan iptek dalam bidang teknologi komunikasi dan informasi.
          </p>

        </div>
        <!--Second column-->
      </div>
      <div class="row">
        <div class="col-md-12 dark-grey-text ml-lg-auto col-md-12 wow fadeIn" data-wow-delay="0.4s">
          
        <p align="justify">Diharapkan dengan adanya website SMK Negeri 1 Padaherang dapat 
          mengimplementasikan pembelajaran berbasis Infomation Technology sehingga secara 
          signifikan meningkatkan kualitas sekolah. Tiada gading yang tak retak, website 
          yang kami buat dalam proses pengembangan, masih banyak kekurangan yang harus kami 
          perbaiki. Kritik dan saran yang membangun sangat kami harapkan untuk pengembangan 
          ke depan.</p>
        <p align="justify">Akhirnya, kami ucapkan terimakasih yang sebesar-besarnya atas 
          segala bantuan dan fasilitasnya yang telah diberikan semoga semua yang 
          kita lakukan bermanfaat bagi masyarakat</p>
        <p><b>Dra. Hj. Nunung Erni Nuraeni, M.MPd</b></p>
        <p><i><b>Terimakasih.</b></i></p>
        </div>
      </div>
      <!--First row-->

    </section>
    <!--Section: About-->

    <hr>
    
  </div>

  <div class="container-fluid background-r">
    <div class="container py-3">

      <!--Section: Blog v.2-->
      <section class="extra-margins text-center" id="courses">

        <h2 class="text-center mb-5 my-5 pt-4 pb-4 font-weight-bold"> Kompetensi Keahlian</h2>

        <!--Grid row-->
        <div class="row mb-5 pb-3">

          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4 wow fadeIn" data-wow-delay="0.4s">

            <!--Card Light-->
            <div class="card">
              <!--Card image-->
              <div class="view overlay">
                <img src="{{url('mdb/img/jurusan/GP.jpg')}}" class="card-img-top" alt="">
                <a>
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!--/.Card image-->
              <!--Card content-->
              <div class="card-body">

                <!--Title-->
                <h4 class="card-title darkgrey-text">
                  <strong>Geologi Pertambangan</strong>
                </h4>
                <hr>
                <!--Text-->
                <p class="font-small">Some quick example text to build on the card title and make up the bulk of the
                  card's
                  content.
                </p>
                <a href="#" class="black-text d-flex flex-row-reverse">
                  <p class="waves-effect p-2 font-small blue-text mb-0">Read more
                    <i class="fas fa-long-arrow-alt-right ml-2" aria-hidden="true"></i>
                  </p>
                </a>
              </div>
              <!--/.Card content-->
            </div>
            <!--/.Card Light-->

          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4 wow fadeIn" data-wow-delay="0.4s">

            <!--Card Light-->
            <div class="card">
              <!--Card image-->
              <div class="view overlay">
                <img src="{{url('mdb/img/jurusan/RPL.jpg')}}" class="card-img-top" alt="">
                <a>
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!--/.Card image-->
              <!--Card content-->
              <div class="card-body">

                <!--Title-->
                <h4 class="card-title darkgrey-text">
                  <strong>Rekayasa Perangkat Lunak</strong>
                </h4>
                <hr>
                <!--Text-->
                <p class="font-small">Some quick example text to build on the card title and make up the bulk of the
                  card's
                  content.
                </p>
                <a href="#" class="black-text d-flex flex-row-reverse">
                  <p class="waves-effect p-2 font-small blue-text mb-0">Read more
                    <i class="fas fa-long-arrow-alt-right ml-2" aria-hidden="true"></i>
                  </p>
                </a>
              </div>
              <!--/.Card content-->
            </div>
            <!--/.Card Light-->

          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4 wow fadeIn" data-wow-delay="0.4s">

            <!--Card Light-->
            <div class="card">
              <!--Card image-->
              <div class="view overlay">
                <img src="{{url('mdb/img/jurusan/TKJ.jpg')}}" class="card-img-top" alt="">
                <a>
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!--/.Card image-->

              <!--Card content-->
              <div class="card-body">

                <!--Title-->
                <h4 class="card-title darkgrey-text">
                  <strong>Teknik komputer & Jaringan</strong>
                </h4>
                <hr>
                <!--Text-->
                <p class="font-small">Some quick example text to build on the card title and make up the bulk of the
                  card's
                  content.
                </p>
                <a href="#" class="black-text d-flex flex-row-reverse">
                  <p class="waves-effect p-2 font-small blue-text mb-0">Read more
                    <i class="fas fa-long-arrow-alt-right ml-2" aria-hidden="true"></i>
                  </p>
                </a>
              </div>
              <!--/.Card content-->
            </div>
            <!--/.Card Light-->

          </div>
          <!--Grid column-->
          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4 wow fadeIn" data-wow-delay="0.4s">

            <!--Card Light-->
            <div class="card">
              <!--Card image-->
              <div class="view overlay">
                <img src="{{url('mdb/img/jurusan/TPMP.jpg')}}" class="card-img-top" alt="">
                <a>
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!--/.Card image-->
              <!--Card content-->
              <div class="card-body">

                <!--Title-->
                <h4 class="card-title darkgrey-text">
                  <strong>Teknik Peng. Migas & Petrokimia</strong>
                </h4>
                <hr>
                <!--Text-->
                <p class="font-small">Some quick example text to build on the card title and make up the bulk of the
                  card's
                  content.
                </p>
                <a href="#" class="black-text d-flex flex-row-reverse">
                  <p class="waves-effect p-2 font-small blue-text mb-0">Read more
                    <i class="fas fa-long-arrow-alt-right ml-2" aria-hidden="true"></i>
                  </p>
                </a>
              </div>
              <!--/.Card content-->
            </div>
            <!--/.Card Light-->

          </div>
          <!--Grid column-->

        </div>
        <!--First row-->

      </section>
      <!--Section: Blog v.2-->

    </div>
  </div>

</main>
<!--Main content-->

<footer class="page-footer text-center text-md-left mdb-color darken-3">

  <!--Footer Links-->
  <div class="container-fluid">

    <!--First row-->
    <div class="row " data-wow-delay="0.2s">

      <!--First column-->
      <div class="col-md-12 text-center mb-3 mt-3">

        <!--Icon-->
        <i class="fas fa-graduation-cap fa-4x orange-text"></i>
        <!--Title-->
        <h2 class="mt-3 mb-3">Join Us</h2>
        <!--Description-->
        <p class="white-text mb-5"></p>
        <!--Reservation button-->
        <a href="#home" class="btn btn-warning">Our Appliction</a>

      </div>
      <!--First column-->

      <hr class="w-100 mt-4 mb-5">

    </div>
    <!--First row-->

  </div>
  <!--Footer Links-->

<!-- Copyright -->
<div class="footer-copyright text-center py-3">
  <div class="container-fluid">
    © 2020 Copyright: <a href="https://web.facebook.com/herlambang.kun.3" target="_blank"> Novi Herlambang </a>
  </div>
</div>
<!-- Copyright -->

</footer>
@endsection

@push('css')
<style>
  html,
  body,
  header,
  .jarallax {
    height: 100%;
  }

  @media (min-width: 560px) and (max-width: 740px) {

    html,
    body,
    header,
    .jarallax {
      height: 500px;
    }
  }

  @media (min-width: 800px) and (max-width: 850px) {

    html,
    body,
    header,
    .jarallax {
      height: 500px;
    }
  }

  @media (min-width: 800px) and (max-width: 850px) {
    .navbar:not(.top-nav-collapse) {
      background: #1C2A48 !important;
    }

    .navbar {
      box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12) !important;
    }
  }

</style>
@endpush