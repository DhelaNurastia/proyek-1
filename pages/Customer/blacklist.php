<?php
$base_url = '/proyek-1/';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Starter Page - Strategy Bootstrap Template</title>
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

  <style>
    /* Additional styles for Blacklist Status section based on DEFAULT inspiration guidelines */
    .blacklist-status-section {
      padding-top: 4rem;
      padding-bottom: 4rem;
      background: transparent !important;
    }
    .blacklist-status-container {
      max-width: 1200px;
      margin-left: auto;
      margin-right: auto;
      padding-left: 1rem;
      padding-right: 1rem;
    }
    .blacklist-card {
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
      background: #fff0f1; /* light red/pink background */
      border-radius: 0.75rem;
      box-shadow: 0 2px 8px rgba(241, 85, 110, 0.25);
      padding: 3rem 2.5rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      color: #b91c1c; /* red-700 */
      text-align: center;
      user-select: none;
    }
    .blacklist-card svg {
      width: 64px;
      height: 64px;
      stroke: #b91c1c;
      stroke-width: 2.5;
      stroke-linecap: round;
      stroke-linejoin: round;
      fill: none;
      margin-bottom: 1rem;
    }
    .blacklist-card h2 {
      font-family: 'Raleway', sans-serif;
      font-weight: 700;
      font-size: 48px;
      margin-bottom: 0.75rem;
      color: #b91c1c;
      line-height: 1.1;
    }
    .blacklist-card p {
      font-family: 'Nunito Sans', sans-serif;
      font-size: 18px;
      color: #6b7280; /* neutral gray text */
      margin-bottom: 1.8rem;
      max-width: 460px;
    }
    .blacklist-card a.btn-contact {
      display: inline-block;
      padding: 0.85rem 2rem;
      font-weight: 700;
      font-size: 16px;
      color: white;
      background-color: #b91c1c;
      border-radius: 0.75rem;
      text-decoration: none;
      box-shadow: 0 4px 10px rgba(185, 28, 28, 0.5);
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      user-select: none;
    }
    .blacklist-card a.btn-contact:hover,
    .blacklist-card a.btn-contact:focus {
      background-color: #991b1b;
      outline: none;
      box-shadow: 0 6px 14px rgba(153, 27, 27, 0.7);
    }
    @media (max-width: 600px) {
      .blacklist-card h2 {
        font-size: 36px;
      }
      .blacklist-card p {
        font-size: 16px;
      }
    }
  </style>

  <!-- =======================================================
  * Template Name: Strategy
  * Template URL: https://bootstrapmade.com/strategy-bootstrap-agency-template/
  * Updated: May 09 2025 with Bootstrap v5.3.6
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="starter-page-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.webp" alt=""> -->
        <h1 class="sitename">Strategy</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#team">Team</a></li>
          <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
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

      <a class="btn-getstarted" href="#about">Get Started</a>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade">
      <div class="container position-relative">
        <h1>Starter Page</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Starter Page</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Blacklist Status Section Inserted Below Starter Section -->
    <section class="blacklist-status-section" aria-labelledby="blacklist-status-title" data-aos="fade-up">
      <div class="blacklist-status-container">
        <article class="blacklist-card" role="alert" aria-live="polite" aria-atomic="true" tabindex="0">
          <svg aria-hidden="true" viewBox="0 0 24 24" focusable="false" role="img" >
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="15" y1="9" x2="9" y2="15"></line>
            <line x1="9" y1="9" x2="15" y2="15"></line>
          </svg>
          <h2 id="blacklist-status-title">Blacklist Status</h2>
          <p>Due to violations or outstanding issues, your account access and rental privileges have been suspended. Please contact support for more information and to resolve the matter.</p>
          <a href="contact.html" class="btn-contact" role="button" aria-label="Contact Support">Contact Support</a>
        </article>
      </div>
    </section>


  </main>

  <footer id="footer" class="footer">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Strategy</span>
          </a>
          <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>A108 Adam Street</p>
          <p>New York, NY 535022</p>
          <p>United States</p>
          <p class="mt-4"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
          <p><strong>Email:</strong> <span>info@example.com</span></p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Strategy</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
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