<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sigma RentCar</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

    <style>
    body {
      margin: 0;
      font-family: 'Nunito Sans', sans-serif;
      background: #ffffff;
      color: #6b7280;
      line-height: 1.6;
      font-size: 17px;
      min-height: 100vh;
      display: flex;
      flex-direction: column; 
      align-items: center;     
      padding: 4rem 1rem 5rem;
    }


    main {
      max-width: 1200px;
      width: 100%;
      padding-top: 4rem;
      padding-bottom: 4rem;
    }

    h2.section-title {
      font-family: 'Raleway', sans-serif;
      font-weight: 700;
      font-size: 48px;
      color: #111827;
      margin-bottom: 0.25rem;
      user-select: none;
    }

    .section-subtitle {
      color: #6b7280;
      font-size: 18px;
      margin-bottom: 2rem;
      font-weight: 600;
      user-select: none;
    }

    .car-list {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 1.75rem;
      padding-top: 1rem;
    }

    .car-card {
      background-color: transparent !important;
      box-shadow: none !important;
      border: 1px solid rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(6px);
      border-radius: 0.75rem;
      box-shadow: 0 6px 16px rgb(0 0 0 / 0.1);
      padding: 1.75rem 2rem;
      font-family: 'Nunito Sans', sans-serif;
      color: white !important;
      transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;
      cursor: pointer;
      user-select: none;
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }


    .car-card:hover,
    .car-card:focus-visible {
      outline: none;
      box-shadow: 0 12px 32px rgba(37, 99, 235, 0.3);
      transform: translateY(-6px);
      background: #f9fafb;
    }

    .car-card:focus-visible {
      box-shadow: 0 0 0 3px #2563eb;
    }

    .car-image {
      width: 100%;
      height: 170px;
      border-radius: 0.5rem;
      object-fit: cover;
      margin-bottom: 1rem;
      box-shadow: 0 4px 12px rgb(0 0 0 / 0.08);
    }

    .car-name {
      font-weight: 700;
      font-size: 1.25rem;
      color: white !important;
      margin-bottom: 0.75rem;
    }

    .car-info-row {
      display: flex;
      flex-wrap: wrap;
      gap: 1.25rem 2rem;
      color: white !important;
      font-size: 1rem;
    }

    .car-info-item {
      display: flex;
      align-items: center;
      gap: 0.375rem;
      min-width: 120px;
    }

    .car-info-item i {
      color: white !important;
      font-size: 1.1rem;
      flex-shrink: 0;
    }

    .rent-button {
      margin-top: 1.5rem;
      display: inline-block;
      width: 100%;
      padding: 0.75rem 0;
      background-color: #2563eb; 
      color: #ffffff;
      font-size: 1rem;
      font-weight: 600;
      text-align: center;
      border: none;
      border-radius: 0.75rem; 
      cursor: pointer;
      transition: all 0.2s ease-in-out;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
      text-decoration: none;
    }

    .rent-button:hover {
      background-color: #1e40af; 
      transform: scale(1.03);
      box-shadow: 0 4px 10px rgba(37, 99, 235, 0.4);
    }
  </style>

  <!-- Favicons -->
  <link href="assets/image/favicon.jpeg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/template/home/Strategy/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/template/home/Strategy/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/template/home/Strategy/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/template/home/Strategy/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/template/home/Strategy/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/template/home/Strategy/assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Strategy
  * Template URL: https://bootstrapmade.com/strategy-bootstrap-agency-template/
  * Updated: May 09 2025 with Bootstrap v5.3.6
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.webp" alt=""> -->
          <img src="assets/image/logo.png" alt="">
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">Tentang Kami</a></li>
          <li><a href="#services">Layanan</a></li>
          <li><a href="#steps">Tahapan</a></li>
          <li><a href="#galeri">Galeri</a></li>
          <li><a href="#catalog">Katalog</a></li>
          <li><a href="#faq">FAQ</a></li>
          <li class="dropdown"><a href="#"><span>Autentifikasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="pages/Halaman_Register&Login/register.php">Daftar</a></li>
              <li><a href="pages/Halaman_Register&Login/login.php">Masuk</a></li>
            </ul>
          </li>
          <li><a href="#contact">Kontak</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="#about">Get Started</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 content-col" data-aos="fade-up">
            <div class="content">
              <div class="agency-name">
                <h5>OUR RENTAL</h5>
              </div>

              <div class="main-heading">
                <h2>Drive Your Journey With <br>Sigma RentCar</h2>
              </div>

              <div class="divider"></div>

              <div class="description">
                <p>Nikmati pengalaman berkendara tanpa repot, cukup klik dan berangkat!</p>
              </div>

              <div class="cta-button">
                <a href="#services" class="btn">
                  <span>Pesan Sekarang</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-5" data-aos="zoom-out">
            <div class="visual-content">
              <div class="fluid-shape">
                <img src="assets/image/logo.png" alt="Abstract Fluid Shape" class="fluid-img">
              </div>
            </div>
          </div>
    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Tentang Kami</h2>
        <div><span>Kenali Kami Lebih Lanjut</span></div>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gx-5 align-items-center">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
            <div class="about-image position-relative">
              <img src="assets/image/road.jpeg" class="img-fluid rounded-4 shadow-sm" alt="About Image" loading="lazy">
            </div>
          </div>

          <div class="col-lg-6 mt-4 mt-lg-0" data-aos="fade-left" data-aos-delay="300">
            <div class="about-content">
              <h2>Meningkatkan Pengalaman Perjalanan Anda Melalui Inovasi</h2>
              <p class="lead">Kami berkomitmen menyediakan layanan rental mobil yang mudah, fleksibel, dan terpercaya untuk memenuhi kebutuhan transportasi Anda.</p>
              <p>Dengan perpaduan teknologi canggih dan pelayanan terbaik, kami membantu pelanggan menikmati perjalanan yang aman, nyaman, dan efisien di tengah dunia yang terus berubah.</p>

              <div class="row g-4 mt-3">
                <div class="col-md-6" data-aos="zoom-in" data-aos-delay="400">
                  <div class="feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <h5>Dukungan Tim Profesional</h5>
                    <p>Tim kami yang berpengalaman siap memberikan layanan personal dan solusi terbaik untuk setiap kebutuhan perjalanan Anda.</p>
                  </div>
                </div>
                <div class="col-md-6" data-aos="zoom-in" data-aos-delay="450">
                  <div class="feature-item">
                    <i class="bi bi-lightbulb-fill"></i>
                    <h5>Pendekatan Inovatif</h5>
                    <p>Kami menerapkan metode terbaru untuk menghadirkan pengalaman sewa mobil yang praktis dan memuaskan bagi setiap pelanggan.</p>
                  </div>
                </div>
              </div>

              <a href="#" class="btn btn-primary mt-4">Explore Our Services</a>
            </div>
          </div>
        </div>

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Layanan</h2>
        <div><span>Cek Layanan</span> <span class="description-title">Kami</span></div>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="service-header">
          <div class="row align-items-center">
            <div class="col-lg-8 col-md-12">
              <div class="service-intro">
                <h2 class="service-heading">
                  <div>Solusi Inovatif</div>
                  <div><span>untuk Kebutuhan Transportasi Anda</span></div>
                </h2>
              </div>
            </div>
            <div class="col-lg-4 col-md-12">
              <div class="service-summary">
                <p>Kami menggabungkan strategi visioner, pendekatan kreatif, dan teknologi terkini untuk memberikan pengalaman sewa mobil yang luar biasa, mendorong kenyamanan pelanggan, dan menjangkau pasar yang lebih luas.</p>
                <a href="services.html" class="service-btn">
                  Lihat Semua Layanan
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-card position-relative z-1">
              <div class="service-icon">
                <i class="bi bi-building"></i>
              </div>
              <h3>
                <a href="service-details.html">
                  Kontrak <span>Perusahaan</span>
                </a>
              </h3>
              <p>Kami menawarkan paket kontrak khusus untuk perusahaan dengan berbagai keuntungan dan layanan ekslusif.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-card position-relative z-1">
              <div class="service-icon">
                <i class="bi bi-airplane"></i>
              </div>
              <h3>
                <a href="service-details.html">
                  Layanan Transportasi<span>Bandara</span>
                </a>
              </h3>
              <p>Kami menyediakan layanan transportasi yang handal dan tepat waktu dari dan ke bandara, demi kenyamanan perjalanan Anda.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-card position-relative z-1">
              <div class="service-icon">
                <i class="bi bi-arrow-up"></i>
              </div>
              <h3>
                <a href="service-details.html">
                    Sewa<span>Satu Arah</span>
                </a>
              </h3>
              <p>Kami menyediakan layanan sewa mobil satu arah untuk memudahkan perjalanan Anda tanpa harus kembali ke titik awal.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-card position-relative z-1">
              <div class="service-icon">
                <i class="bi bi-house"></i>
              </div>
              <h3>
                <a href="service-details.html">
                Layanan Penjemputan<span>di Rumah</span>
                </a>
              </h3>
              <p>Nikmati kenyamanan layanan penjemputan langsung dari rumah Anda. Kami siap memberikan layanan terbaik dengan kenyamanan maksimal.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-card position-relative z-1">
              <div class="service-icon">
                <i class="bi bi-gem"></i>
              </div>
              <h3>
                <a href="service-details.html">
                Pendekatan <span>Profesional</span>
                </a>
              </h3>
              <p>Kami mengundang Anda untuk merasakan layanan kami yang inovatif dan terpercaya. Kami menyediakan layanan yang siap memenuhi kebutuhan Anda.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-card position-relative z-1">
              <div class="service-icon">
                <i class="bi bi-code-slash"></i>
              </div>
              <h3>
                <a href="service-details.html">
                  Solusi Transportasi<span>Anda</span>
                </a>
              </h3>
              <p>Tidak ada yang lebih profesional dan handal dalam melayani kebutuhan transportasi Anda. Tim kami siap memberikan pengalaman terbaik untuk perjalanan Anda.</p>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Steps Section -->
    <section id="steps" class="steps section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Tahapan</h2>
        <div><span>Tahapan</span> <span class="description-title">Sewa Mobil</span></div>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="steps-wrapper">

          <div class="step-item" data-aos="fade-right" data-aos-delay="200">
            <div class="step-content">
              <div class="step-icon">
                <i class="bi bi-lightbulb"></i>
              </div>
              <div class="step-info">
                <span class="step-number">Langkah Pertama</span>
                <h3>Masuk atau Daftar Akun</h3>
                <p>Mulailah dengan login ke akun Anda. Jika belum memiliki akun, silakan daftar terlebih dahulu untuk menikmati kemudahan layanan kami.</p>
              </div>
            </div>
          </div><!-- End Step Item -->

          <div class="step-item" data-aos="fade-left" data-aos-delay="300">
            <div class="step-content">
              <div class="step-icon">
                <i class="bi bi-gear"></i>
              </div>
              <div class="step-info">
                <span class="step-number">Langkah Ke-dua</span>
                <h3>Pilih Mobil Sesuai Kebutuhan</h3>
                <p>Jelajahi berbagai pilihan mobil yang tersedia. Pilih kendaraan yang sesuai dengan kebutuhan dan preferensi perjalanan Anda.</p>
              </div>
            </div>
          </div><!-- End Step Item -->

          <div class="step-item" data-aos="fade-right" data-aos-delay="400">
            <div class="step-content">
              <div class="step-icon">
                <i class="bi bi-bar-chart"></i>
              </div>
              <div class="step-info">
                <span class="step-number">Langkah Ke-tiga</span>
                <h3>Isi Formulir Pemesanan</h3>
                <p>Lengkapi formulir yang telah kami sediakan dengan detail perjalanan Anda, seperti tanggal sewa, lokasi penjemputan, dan informasi lainnya.</p>
              </div>
            </div>
          </div><!-- End Step Item -->

          <div class="step-item" data-aos="fade-left" data-aos-delay="500">
            <div class="step-content">
              <div class="step-icon">
                <i class="bi bi-check2-circle"></i>
              </div>
              <div class="step-info">
                <span class="step-number">Langkah Ke-empat</span>
                <h3>Lakukan Pembayaran & Ambil Mobil</h3>
                <p>Lakukan pembayaran sesuai harga yang tertera. Setelah itu, mobil siap diambil di lokasi yang telah disepakati.</p>
              </div>
            </div>
          </div><!-- End Step Item -->

        </div>

      </div>

    </section><!-- /Steps Section -->

    <!-- Portfolio Section -->
    <section id="galeri" class="galeri section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Galeri</h2>
        <div><span>Lihat Galeri</span> <span class="description-title">Kami</span></div>
      </div><!-- End Section Title -->

          <div class="row g-4 isotope-container" data-aos="fade-up" data-aos-delay="300">

            <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item isotope-item filter-ui">
              <article class="portfolio-entry">
                <figure class="entry-image">
                  <img src="assets/image/galeri/pertama.jpeg" class="img-fluid" alt="" loading="lazy">
                  <div class="entry-overlay">
                    <div class="overlay-content">
                    </div>
                  </div>
                </figure>
              </article>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item isotope-item filter-development">
              <article class="portfolio-entry">
                <figure class="entry-image">
                  <img src="assets/image/galeri/kedua.jpeg" class="img-fluid" alt="" loading="lazy">
                  <div class="entry-overlay">
                    <div class="overlay-content">
                    </div>
                  </div>
                </figure>
              </article>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item isotope-item filter-photography">
              <article class="portfolio-entry">
                <figure class="entry-image">
                  <img src="assets/image/galeri/ketiga.jpeg" class="img-fluid" alt="" loading="lazy">
                  <div class="entry-overlay">
                    <div class="overlay-content">
                    </div>
                  </div>
                </figure>
              </article>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item isotope-item filter-marketing">
              <article class="portfolio-entry">
                <figure class="entry-image">
                  <img src="assets/image/galeri/keempat.jpeg" class="img-fluid" alt="" loading="lazy">
                  <div class="entry-overlay">
                    <div class="overlay-content">
                    </div>
                  </div>
                </figure>
              </article>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item isotope-item filter-ui">
              <article class="portfolio-entry">
                <figure class="entry-image">
                  <img src="assets/image/galeri/kelima.jpeg" class="img-fluid" alt="" loading="lazy">
                  <div class="entry-overlay">
                    <div class="overlay-content">
                    </div>
                  </div>
                </figure>
              </article>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item isotope-item filter-development">
              <article class="portfolio-entry">
                <figure class="entry-image">
                  <img src="assets/image/galeri/keenam.jpeg" class="img-fluid" alt="" loading="lazy">
                  <div class="entry-overlay">
                    <div class="overlay-content">
                    </div>
                  </div>
                </figure>
              </article>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item isotope-item filter-photography">
              <article class="portfolio-entry">
                <figure class="entry-image">
                  <img src="assets/image/galeri/ketujuh.jpeg" class="img-fluid" alt="" loading="lazy">
                  <div class="entry-overlay">
                    <div class="overlay-content">
                    </div>
                  </div>
                </figure>
              </article>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item isotope-item filter-marketing">
              <article class="portfolio-entry">
                <figure class="entry-image">
                  <img src="assets/image/galeri/kedelapan.jpeg" class="img-fluid" alt="" loading="lazy">
                  <div class="entry-overlay">
                    <div class="overlay-content">
                    </div>
                  </div>
                </figure>
              </article>
            </div><!-- End Portfolio Item -->

          </div><!-- End Portfolio Container -->

        </div>

      </div>

    </section><!-- /Portfolio Section -->

    <!-- Catalog Section -->
    <section id="catalog" class="catalog section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Katalog</h2>
        <div><span>Cek Unit</span> <span class="description-title">Kami</span></div>
      </div><!-- End Section Title -->

      <?php
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db   = "proyek-1";

        $conn = new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error) {
          die("Koneksi gagal: " . $conn->connect_error);
        }

        $sql = "SELECT unit_mobil.*, jenis_mobil.nama AS nama_mobil, jenis_mobil.harga_sewa, jenis_mobil.jumlah_kursi
                FROM unit_mobil
                JOIN jenis_mobil ON unit_mobil.jenis_mobil_id = jenis_mobil.id
                WHERE unit_mobil.status = 'tersedia'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0): ?>
        <div class="car-list" role="list">
          <?php while($row = $result->fetch_assoc()): ?>
            <article class="car-card" tabindex="0" role="listitem" aria-label="Mobil <?= $row['nama_mobil']; ?>, harga <?= number_format($row['harga_sewa'], 0, ',', '.'); ?> rupiah per 12 jam, transmisi <?= $row['transmisi']; ?>, <?= $row['jumlah_kursi']; ?> kursi, plat nomor <?= $row['plat_nomor']; ?>, warna <?= $row['warna']; ?>">
              <img
                src="<?= !empty($row['foto']) ? 'uploads/dokumen-user/foto-mobil/' . $row['foto'] : 'https://via.placeholder.com/300x170?text=No+Image'; ?>"
                alt="Foto mobil <?= $row['nama_mobil']; ?> warna <?= $row['warna']; ?>"
                class="car-image"
              />
              <h3 class="car-name"><?= $row['nama_mobil']; ?></h3>
              <div class="car-info-row">
                <div class="car-info-item" title="Harga per 12 jam">
                  <i class="bi bi-cash-coin"></i>
                  Rp<?= number_format($row['harga_sewa'], 0, ',', '.'); ?>
                </div>
                <div class="car-info-item" title="Transmisi">
                  <i class="bi bi-gear"></i>
                  <?= $row['transmisi']; ?>
                </div>
                <div class="car-info-item" title="Jumlah Kursi">
                  <i class="bi bi-people"></i>
                  <?= $row['jumlah_kursi']; ?> Kursi
                </div>
                <div class="car-info-item" title="Plat Nomor">
                  <i class="bi bi-card-text"></i>
                  <?= $row['plat_nomor']; ?>
                </div>
                <div class="car-info-item" title="Warna">
                  <i class="bi bi-palette"></i>
                  <?= $row['warna']; ?>
                </div>
              </div>
              <a href="pages/Halaman_Register&Login/login.php" class="rent-button">Rental Sekarang</a>
            </article>
          <?php endwhile; ?>
        </div>
      <?php else: ?>
        <p>Tidak ada mobil tersedia saat ini.</p>
      <?php endif; ?>
    </section>
        </div>

      </div>

    </section><!-- /Team Section -->

    <!-- Faq Section -->
    <section class="faq-9 faq section" id="faq">

      <div class="container">
        <div class="row">

          <div class="col-lg-5" data-aos="fade-up">
            <h2 class="faq-title">Butuh jawaban cepat? Kunjungi FAQ</h2>
            <p class="faq-description">Temukan jawaban atas pertanyaan umum seputar layanan, pemesanan, dan kebijakan rental mobil kami di halaman FAQ.</p>
            <div class="faq-arrow d-none d-lg-block" data-aos="fade-up" data-aos-delay="200">
              <svg class="faq-arrow" width="200" height="211" viewBox="0 0 200 211" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M198.804 194.488C189.279 189.596 179.529 185.52 169.407 182.07L169.384 182.049C169.227 181.994 169.07 181.939 168.912 181.884C166.669 181.139 165.906 184.546 167.669 185.615C174.053 189.473 182.761 191.837 189.146 195.695C156.603 195.912 119.781 196.591 91.266 179.049C62.5221 161.368 48.1094 130.695 56.934 98.891C84.5539 98.7247 112.556 84.0176 129.508 62.667C136.396 53.9724 146.193 35.1448 129.773 30.2717C114.292 25.6624 93.7109 41.8875 83.1971 51.3147C70.1109 63.039 59.63 78.433 54.2039 95.0087C52.1221 94.9842 50.0776 94.8683 48.0703 94.6608C30.1803 92.8027 11.2197 83.6338 5.44902 65.1074C-1.88449 41.5699 14.4994 19.0183 27.9202 1.56641C28.6411 0.625793 27.2862 -0.561638 26.5419 0.358501C13.4588 16.4098 -0.221091 34.5242 0.896608 56.5659C1.8218 74.6941 14.221 87.9401 30.4121 94.2058C37.7076 97.0203 45.3454 98.5003 53.0334 98.8449C47.8679 117.532 49.2961 137.487 60.7729 155.283C87.7615 197.081 139.616 201.147 184.786 201.155L174.332 206.827C172.119 208.033 174.345 211.287 176.537 210.105C182.06 207.125 187.582 204.122 193.084 201.144C193.346 201.147 195.161 199.887 195.423 199.868C197.08 198.548 193.084 201.144 195.528 199.81C196.688 199.192 197.846 198.552 199.006 197.935C200.397 197.167 200.007 195.087 198.804 194.488ZM60.8213 88.0427C67.6894 72.648 78.8538 59.1566 92.1207 49.0388C98.8475 43.9065 106.334 39.2953 114.188 36.1439C117.295 34.8947 120.798 33.6609 124.168 33.635C134.365 33.5511 136.354 42.9911 132.638 51.031C120.47 77.4222 86.8639 93.9837 58.0983 94.9666C58.8971 92.6666 59.783 90.3603 60.8213 88.0427Z" fill="currentColor"></path>
              </svg>
            </div>
          </div>

          <div class="col-lg-7" data-aos="fade-up" data-aos-delay="300">
            <div class="faq-container">

              <div class="faq-item faq-active">
                <h3>Apa saja persyaratan untuk menyewa mobil?</h3>
                <div class="faq-content">
                  <p>Cukup memberikan dokumen seperti KK, KTP, dan SIM. Jika pertama kali menyewa di Sigma RentCar harus menyertakan jaminan berupa uang senilai 1.000.000 atau menyimpan motor.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Apakah saya bisa menyewa mobil tanpa sopir (lepas kunci)?</h3>
                <div class="faq-content">
                  <p>Ya, kami menyediakan layanan sewa mobil lepas kunci, namun hanya untuk pelanggan yang memenuhi syarat administrasi dan lolos verifikasi data. Proses ini bertujuan untuk menjaga keamanan dan kenyamanan bersama.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Apa yang terjadi jika saya terlambat mengembalikan mobil?</h3>
                <div class="faq-content">
                  <p>Keterlambatan pengembalian akan dikenakan biaya tambahan sesuai tarif per jam yang berlaku. Jika keterlambatan melebihi 4 jam dari waktu seharusnya, maka akan dikenakan biaya sewa 1 hari penuh.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3> Apakah harga sewa sudah termasuk bensin dan tol?</h3>
                <div class="faq-content">
                  <p>Tidak. Harga sewa yang tertera hanya mencakup biaya penggunaan kendaraan. Biaya bensin, tol, parkir, dan biaya operasional lainnya menjadi tanggung jawab penyewa.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Apakah bisa melakukan pemesanan secara online?</h3>
                <div class="faq-content">
                  <p>Tentu. Anda dapat melakukan pemesanan langsung melalui website kami dengan mengisi formulir booking dan melampirkan dokumen yang dibutuhkan. Setelah verifikasi, tim kami akan menghubungi Anda untuk konfirmasi.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Apakah saya bisa membatalkan pesanan? Apakah ada biaya pembatalan?</h3>
                <div class="faq-content">
                  <p>Ya, pembatalan dapat dilakukan maksimal 24 jam sebelum waktu sewa tanpa biaya. Jika pembatalan dilakukan kurang dari 24 jam sebelum waktu sewa, akan dikenakan biaya pembatalan sebesar 50% dari total biaya sewa.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>
          </div>

        </div>
      </div>
    </section><!-- /Faq Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Kontak</h2>
        <div><span>Hubungi</span> <span class="description-title">Kami</span></div>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Contact Info Boxes -->
        <div class="row gy-4 mb-5">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="contact-info-box">
              <div class="icon-box">
                <i class="bi bi-geo-alt"></i>
              </div>
              <div class="info-content">
                <h4>Alamat</h4>
                <p>Jl.Letnan Jendral S.Parman <br> (belakang Alfamart benpas)</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="contact-info-box">
              <div class="icon-box">
                <i class="bi bi-envelope"></i>
              </div>
              <div class="info-content">
                <h4>Alamat Email</h4>
                <p>diki.a.gani@gmail.com<</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="contact-info-box">
              <div class="icon-box">
                <i class="bi bi-headset"></i>
              </div>
              <div class="info-content">
                <h4>Jam Operasiona</h4>
                <p>Setiap Hari: 24 Jam</p>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Google Maps (Full Width) -->
      <div class="map-section" data-aos="fade-up" data-aos-delay="200">
        <iframe src="https://www.google.com/maps/embed?pb=!3m2!1sid!2sid!4v1748557127752!5m2!1sid!2sid!6m8!1m7!1saeCPQmBQoaLH3l9KsB5imA!2m2!1d-6.573965375823104!2d107.7642212194211!3f52.75634532104675!4f-31.14106148219296!5f0.7820865974627469" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

      <!-- Contact Form Section (Overlapping) -->
      <div class="container form-container-overlap">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="300">
          <div class="col-lg-10">
            <div class="contact-form-wrapper">
              <h2 class="text-center mb-4">Sapa Kami</h2>

              <form action="forms/contact.php" method="post" class="php-email-form">
                <div class="row g-3">
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-with-icon">
                        <i class="bi bi-person"></i>
                        <input type="text" class="form-control" name="name" placeholder="First Name" required="">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-with-icon">
                        <i class="bi bi-envelope"></i>
                        <input type="email" class="form-control" name="email" placeholder="Email Address" required="">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="input-with-icon">
                        <i class="bi bi-text-left"></i>
                        <input type="text" class="form-control" name="sbject" placeholder="Subject" required="">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <div class="input-with-icon">
                        <i class="bi bi-chat-dots message-icon"></i>
                        <textarea class="form-control" name="message" placeholder="Write Message..." style="height: 180px" required=""></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Pesan Anda telah terkirim. Terima Kasih!</div>
                  </div>

                  <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary btn-submit">KIRIM PESAN</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Sigma RentCar</span>
          </a>
          <p>Sigma RentCar, solusi rental mobil terpercaya untuk berbagai kebutuhan anda. Kami hadir dengan komitmen menghadirkan layanan yang mudah, nyaman, dan dapat diandalkan.</p>
          <div class="social-links d-flex mt-4">
            <a href="https://www.tiktok.com/@sigma_rentcar?_t=ZS-8wtmnFIOOvd&_r=1"><i class="bi bi-tiktok"></i></a>
            <a href="https://www.facebook.com/share/16bwovUwpX/?mibextid=wwXIfr"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/sigma_rentcar?igsh=dG1id2E2enRubGJj"><i class="bi bi-instagram"></i></a>
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
          <p>Jl. Letnan Jenderal S.Parman</p>
          <p>Subang, Jawa Barat</p>
          <p>Indonesia</p>
          <p class="mt-4"><strong>Nomer Hp:</strong> <span>+62 8121 2280 564</span></p>
          <p><strong>Email:</strong> <span>diki.a.gani@gmail.com</span></p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Sigma RentCar</strong> <span>All Rights Reserved</span></p>
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
  <script src="assets/template/home/Strategy/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/template/home/Strategy/assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/template/home/Strategy/assets/vendor/aos/aos.js"></script>
  <script src="assets/template/home/Strategy/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/template/home/Strategy/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/template/home/Strategy/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/template/home/Strategy/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/template/home/Strategy/assets/js/main.js"></script>

</body>

</html>