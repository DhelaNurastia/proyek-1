<?php
$base_url = '/proyek-1/';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Riwayat Booking</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="<?= $base_url ?>assets/image/favicon.jpeg" rel="icon">
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Strategy
  * Template URL: https://bootstrapmade.com/strategy-bootstrap-agency-template/
  * Updated: May 09 2025 with Bootstrap v5.3.6
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    /* Additional styles for Booking History Section */
    .booking-history {
      background-color: transparent !important;
      padding-top: 4rem;
      padding-bottom: 4rem;
      color: #6b7280; /* neutral gray */
      font-feature-settings: "tnum"; /* tabular numbers for cost */
    }
    .booking-history h2 {
      font-weight: 700;
      font-size: 2.5rem;
      color: #111827;
      margin-bottom: 2rem;
    }
    .booking-card {
      background-color: #374151;
      border-radius: 0.75rem;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      padding: 1.5rem 2rem;
      margin-bottom: 1.5rem;
      transition: box-shadow 0.3s ease, transform 0.3s ease;
      cursor: default;
    }
    .booking-card:hover,
    .booking-card:focus {
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
      transform: translateY(-4px);
      outline: none;
    }
    .booking-info {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 1rem 3rem;
      font-size: 1rem;
      color: white !important; 
    }
    .booking-label {
      font-weight: 600;
      color: white !important;
      margin-bottom: 0.25rem;
      display: block;
      font-size: 0.875rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }
    .booking-status {
      font-weight: 700;
      border-radius: 0.5rem;
      padding: 0.25rem 0.75rem;
      display: inline-block;
      font-size: 0.9rem;
      user-select: none;
      text-transform: capitalize;
    }
    .status-confirmed {
      background-color: #d1fae5;
      color: #065f46;
    }
    .status-pending {
      background-color: #fef3c7;
      color: #92400e;
    }
    .status-canceled {
      background-color: #fee2e2;
      color: #991b1b;
    }
  </style>
</head>

<body class="starter-page-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.webp" alt=""> -->
        <h1 class="sitename">Sigma RenctCar</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="listing.php">Daftar Mobil</a></li>
          <li><a href="riwayat.php" class="active">Riwayat Booking</a></li>
          <li class="dropdown"><a href="#"><span>Akun</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="blacklist.php">Status Blacklist</a></li>
              <li><a href="../Halaman_Register&Login/logout.php">LogOut</a></li>
            </ul>
          </li>
          <li><a href="#contact">Kontak</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade">
      <div class="container position-relative">
        <h1>Riwayat Pemesanan Mobil</h1>
        <p>Lihat kembali daftar pemesanan mobil yang pernah Anda lakukan.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Riwayat Booking</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Booking History Section -->
    <section id="booking-history" class="booking-history" aria-label="Booking History section">
      <div class="container">

        <article class="booking-card" tabindex="0" aria-labelledby="booking1-id booking1-unit">
          <div class="booking-info">
            <div>
              <span class="booking-label" id="booking1-id">Booking ID</span>
              <span>#BK20240001</span>
            </div>
            <div>
              <span class="booking-label" id="booking1-unit">Unit Name</span>
              <span>Executive Suite</span>
            </div>
            <div>
              <span class="booking-label">Date</span>
              <time datetime="2024-04-21">April 21, 2024</time>
            </div>
            <div>
              <span class="booking-label">Time</span>
              <time datetime="2024-04-21T14:00">14:00</time>
            </div>
            <div>
              <span class="booking-label">Total Cost</span>
              <span>$450.00</span>
            </div>
            <div>
              <span class="booking-label">Status</span>
              <span class="booking-status status-confirmed">Confirmed</span>
            </div>
          </div>
        </article>

        <article class="booking-card" tabindex="0" aria-labelledby="booking2-id booking2-unit">
          <div class="booking-info">
            <div>
              <span class="booking-label" id="booking2-id">Booking ID</span>
              <span>#BK20240002</span>
            </div>
            <div>
              <span class="booking-label" id="booking2-unit">Unit Name</span>
              <span>Deluxe Room</span>
            </div>
            <div>
              <span class="booking-label">Date</span>
              <time datetime="2024-04-27">April 27, 2024</time>
            </div>
            <div>
              <span class="booking-label">Time</span>
              <time datetime="2024-04-27T18:30">18:30</time>
            </div>
            <div>
              <span class="booking-label">Total Cost</span>
              <span>$320.00</span>
            </div>
            <div>
              <span class="booking-label">Status</span>
              <span class="booking-status status-pending">Pending</span>
            </div>
          </div>
        </article>

        <article class="booking-card" tabindex="0" aria-labelledby="booking3-id booking3-unit">
          <div class="booking-info">
            <div>
              <span class="booking-label" id="booking3-id">Booking ID</span>
              <span>#BK20240003</span>
            </div>
            <div>
              <span class="booking-label" id="booking3-unit">Unit Name</span>
              <span>Standard Suite</span>
            </div>
            <div>
              <span class="booking-label">Date</span>
              <time datetime="2024-05-05">May 5, 2024</time>
            </div>
            <div>
              <span class="booking-label">Time</span>
              <time datetime="2024-05-05T12:45">12:45</time>
            </div>
            <div>
              <span class="booking-label">Total Cost</span>
              <span>$290.00</span>
            </div>
            <div>
              <span class="booking-label">Status</span>
              <span class="booking-status status-canceled">Canceled</span>
            </div>
          </div>
        </article>
      </div>
    </section>

  </main>

  <footer id="footer" class="footer">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Sigma RentCar</span>
          </a>
          <p>Sigma RentCar, solusi rental mobil terpercaya untuk berbagai kebutuhan anda. Kami hadir dengan komitmen menghadirkan layanan yang mudah, nyaman, dan dapat diandalkan</p>
          <div class="social-links d-flex mt-4">
            <a href="https://www.tiktok.com/@sigma_rentcar?_t=ZS-8wtmnFIOOvd&_r=1"><i class="bi bi-tiktok"></i></a>
            <a href="https://www.facebook.com/share/16bwovUwpX/?mibextid=wwXIfr"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/sigma_rentcar?igsh=dG1id2E2enRubGJj"><i class="bi bi-instagram"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Tautan Penting</h4>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">Tentang Kami</a></li>
            <li><a href="listing.php">Daftar Mobil</a></li>
            <li><a href="#galeri">Galeri</a></li>
            <li><a href="#faq">FAQ</a></li>
          </ul>
        </div>

         <div class="col-lg-2 col-6 footer-links">
          <h4>Layanan Kami</h4>
          <ul>
            <li>Rental 24 Jam</a></li>
            <li>Rental Harian</a></li>
            <li>Rental Mingguan</a></li>
            <li>Rental Mobil dengan Supir</a></li>
            <li>Rental Mobil Lepas Kunci</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Kontak Kami</h4>
          <p>Jl.Letnan Jenderal S.Parman</p>
          <p>Subang, Jawa Barat</p>
          <p>Indonesia</p>
          <p class="mt-4"><strong>Nomer Hp:</strong> <span>+62 8121 2280 564</span></p>
          <p><strong>Email:</strong> <span>diki.a.gani@gmail.com</span></p>
        </div>

    <div class="container copyright text-center mt-4">
      <p>
        © <span>Copyright</span> <strong class="px-1 sitename">Sigma RenctCar</strong>
        <span>All Rights Reserved</span>
      </p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form:
        [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/php-email-form/validate.js"></script>
  <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/aos/aos.js"></script>
  <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="<?= $base_url ?>assets/template/home/Strategy/assets/js/main.js"></script>

</body>

</html>