<?php
$base_url = '/proyek-1/';
session_start();
require_once '../../koneksi.php'; // pastikan koneksi DB udah siap

$nama = 'User';
if (isset($_SESSION['user_id'])) {
  $id = $_SESSION['user_id'];
  $stmt = $db->prepare("SELECT nama FROM users WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
    $nama = $row['nama'];
  }
}

$user_id = $_SESSION['user_id'];
$notif = mysqli_query($db, "SELECT * FROM notifikasi WHERE user_id = '$user_id' AND role_tujuan = 'customer' AND dibaca = 0");

while ($row = mysqli_fetch_assoc($notif)) {
  echo "<div class='alert alert-info'>{$row['pesan']}</div>";
  // tandai sebagai dibaca
  mysqli_query($db, "UPDATE notifikasi SET dibaca = 1 WHERE id = {$row['id']}");
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sigma RentCar</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="<?= $base_url ?>assets/image/favicon.jpeg" rel="icon">
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Lato:wght@400;700&family=Montserrat:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Vendor CSS Files -->
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/css/main.css" rel="stylesheet">

  <!-- Icon Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


  <style>
    .notifikasi-teks {
      font-size: 0.95rem;
      color: #856404;
      /* warna cokelat seperti warning */
      margin-top: 10px;
      display: inline-block;
    }

    .notifikasi-teks.danger {
      color: #721c24;
      /* merah untuk ditolak */
    }

    .notifikasi-teks i {
      margin-right: 6px;
      font-size: 1rem;
      vertical-align: middle;
    }
  </style>



</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.webp" alt=""> -->
        <h1 class="sitename">Sigma RentCar</h1>

      </a>
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php" class="active">Home</a></li>
          <li><a href="listing.php">Daftar Mobil</a></li>
          <li class="dropdown"><a href="#"><span>Riwayat</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="riwayat.php" class="active">Riwayat Booking</a></li>
              <li><a href="denda.php">Riwayat Denda</a></li>
            </ul>
          <li class="dropdown"><a href="#"><span>Akun</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="/proyek-1/pages/Halaman_Register&Login/logout.php">LogOut</a></li>
            </ul>
          </li>
          <li><a href="#contact">Kontak</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 content-col" data-aos="fade-up">
            <div class="content">

              <div class="main-heading">
                <h2><b>Selamat Datang Kembali, <?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?>!</b></h2>
              </div>
              <?php
              $user_id = $_SESSION['user_id'];
              $q = mysqli_query($db, "SELECT status_verifikasi FROM users WHERE id = '$user_id'");
              $row = mysqli_fetch_assoc($q);

              if ($row['status_verifikasi'] === 'belum diverifikasi') {
                echo "<div class='notifikasi-teks'><i class='bi bi-exclamation-circle'></i>Akun Anda sedang menunggu verifikasi oleh admin <br> untuk dapat melakukan pemesanan.</div>";
              } elseif ($row['status_verifikasi'] === 'ditolak') {
                echo "<div class='notifikasi-teks danger'><i class='bi bi-x-circle'></i>Verifikasi akun Anda ditolak. Silakan hubungi admin.</div>";
              }
              ?>


              <div class="divider"></div>

              <div class="description">
                <p>Siap melanjutkan perjalananmu?</p>
              </div>

              <div class="cta-button">
                <a href="listing.php" class="btn">
                  <span>Pesan Sekarang</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-5" data-aos="zoom-out">
            <div class="visual-content">
              <div class="fluid-shape">
                <img src="<?= $base_url ?>assets/image/logo.png" alt="Abstract Fluid Shape" class="fluid-img">
              </div>
            </div>
          </div>
    </section><!-- /Hero Section -->

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
                <p>diki.a.gani@gmail.com</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="contact-info-box">
              <div class="icon-box">
                <i class="bi bi-headset"></i>
              </div>
              <div class="info-content">
                <h4>Jam Operasional</h4>
                <p>Setiap Hari: 24 Jam</p>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Google Maps (Full Width) -->
      <div class="map-section" data-aos="fade-up" data-aos-delay="200">
        <iframe src="https://www.google.com/maps/embed?pb=!3m2!1sid!2sid!4v1748557127752!5m2!1sid!2sid!6m8!1m7!1saeCPQmBQoaLH3l9KsB5imA!2m2!1d-6.573965375823104!2d107.7642212194211!3f52.75634532104675!4f-31.14106148219296!5f0.7820865974627469" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

      <!-- Contact Form Section (Overlapping) -->
      <div class="container form-container-overlap">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="300">
          <div class="col-lg-10">
            <div class="contact-form-wrapper">
              <h2 class="text-center mb-4">Sapa Kami</h2>

              <form action="https://formsubmit.co/jhynjngf@gmail.com" method="POST">
                <!-- Ganti youremail@example.com dengan email tujuan -->

                <!-- Anti-spam honeypot (opsional tapi disarankan) -->
                <input type="text" name="_honey" style="display:none"></input>

                <!-- Nonaktifkan captcha bawaan jika kamu ingin -->
                <input type="hidden" name="_captcha" value="true"></input>

                <!-- Redirect ke halaman setelah sukses kirim -->

                <div class="row g-3">
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-with-icon">
                        <i class="bi bi-person"></i>
                        <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" required="">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-with-icon">
                        <i class="bi bi-envelope"></i>
                        <input type="email" class="form-control" name="email" placeholder="Alamat Email" required="">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="input-with-icon">
                        <i class="bi bi-text-left"></i>
                        <input type="text" class="form-control" name="subject" placeholder="Perihal" required="">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <div class="input-with-icon">
                        <i class="bi bi-chat-dots message-icon"></i>
                        <textarea class="form-control" name="message" placeholder="Tulis Pesan..." style="height: 180px" required=""></textarea>
                      </div>
                    </div>
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
  <script src="<?= $base_url ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="<?= $base_url ?>assets/template/home/Strategy/assets/js/main.js"></script>

</body>

</html>