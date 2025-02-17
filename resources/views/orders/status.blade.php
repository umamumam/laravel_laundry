<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index - Yummy Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link rel="icon" href="{{ asset('yummy/assets/img/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('yummy/assets/img/apple-touch-icon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('yummy/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('yummy/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('yummy/assets/vendor/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('yummy/assets/vendor/glightbox/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('yummy/assets/vendor/swiper/swiper-bundle.min.css') }}">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('yummy/assets/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- =======================================================
    * Template Name: Yummy
    * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
    * Updated: Aug 07 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body class="starter-page-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="yummy/assets/img/logo.png" alt=""> -->
                <h1 class="sitename">LAUNDRY</h1>
                <span>.</span>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home<br></a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#menu">Menu</a></li>
                    <li><a href="#events">Events</a></li>
                    <li><a href="#chefs">Chefs</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                    <li class="dropdown"><a href="#"><span>Dropdown</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Dropdown 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                        class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li><a href="#">Deep Dropdown 1</a></li>
                                    <li><a href="#">Deep Dropdown 2</a></li>
                                    <li><a href="#">Deep Dropdown 3</a></li>
                                    <li><a href="#">Deep Dropdown 4</a></li>
                                    <li><a href="#">Deep Dropdown 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Dropdown 2</a></li>
                            <li><a href="#">Dropdown 3</a></li>
                            <li><a href="#">Dropdown 4</a></li>
                        </ul>
                    </li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="/">Back</a>

        </div>
    </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="container">
        <h1>Cek Status Pesanan</h1>
        <div class="card">
            <div class="card-header bg-info text-white">
                {{-- <h5><i class="fas fa-search"></i> Cek Status Pesanan</h5> --}}
            </div>
            <div class="card-body">
                <form action="{{ route('orders.check') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="order_code" class="form-label">Masukkan Kode Pesanan</label>
                        <input type="text" name="order_code" id="order_code" class="form-control"
                            placeholder="Contoh: ORD-12345" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cek Status</button>
                </form>
            </div>
        </div>
      </div>
    </div><!-- End Page Title -->

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Starter Section</h2>
        <p><span>Hasil</span> <span class="description-title">Pencarian</span></p>
        @if (isset($order))
        <div class="card mt-3">
            <div class="card-header bg-success text-white">
                {{-- <h5><i class="fas fa-info-circle"></i> Hasil Pencarian</h5> --}}
            </div>
            <div class="card-body text-center">
                <table style="margin: 0 auto; width: 50%; margin-left: 450px;">
                    <tr>
                        <td style="text-align: left;"><strong>Kode Pesanan</strong></td>
                        <td style="text-align: left;">:</td>
                        <td style="text-align: left;">{{ $order->order_code }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;"><strong>Nama Pelanggan</strong></td>
                        <td style="text-align: left;">:</td>
                        <td style="text-align: left;">{{ $order->customer->name }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;"><strong>Layanan</strong></td>
                        <td style="text-align: left;">:</td>
                        <td style="text-align: left;">{{ $order->service->service_name }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;"><strong>Jumlah</strong></td>
                        <td style="text-align: left;">:</td>
                        <td style="text-align: left;">{{ $order->quantity }} Kg</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;"><strong>Total Harga</strong></td>
                        <td style="text-align: left;">:</td>
                        <td style="text-align: left;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;"><strong>Tanggal Masuk</strong></td>
                        <td style="text-align: left;">:</td>
                        <td style="text-align: left;">{{ \Carbon\Carbon::parse($order->tgl_masuk)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;"><strong>Status</strong></td>
                        <td style="text-align: left;">:</td>
                        <td style="text-align: left;"><span class="badge bg-warning">{{ $order->status->status_name }}</span></td>
                    </tr>
                </table>
            </div>
            
        </div>
    @elseif (isset($not_found))
        <div class="alert alert-danger mt-3">
            <i class="fas fa-exclamation-triangle"></i> Data tidak ditemukan! Pastikan kode pesanan yang dimasukkan benar.
        </div>
    @endif
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up">
        <p>Use this page as a starter for your own custom pages.</p>
      </div>

    </section><!-- /Starter Section Section -->

  </main>

  <footer id="footer" class="footer dark-background">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div class="address">
            <h4>Address</h4>
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p></p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Contact</h4>
            <p>
              <strong>Phone:</strong> <span>+1 5589 55488 55</span><br>
              <strong>Email:</strong> <span>info@example.com</span><br>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Opening Hours</h4>
            <p>
              <strong>Mon-Sat:</strong> <span>11AM - 23PM</span><br>
              <strong>Sunday</strong>: <span>Closed</span>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Yummy</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('yummy/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('yummy/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('yummy/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('yummy/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('yummy/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('yummy/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('yummy/assets/js/main.js') }}"></script>

</body>

</html>