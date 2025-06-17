<?php
session_start();
require_once '../../koneksi.php'; // pastikan path-nya sesuai

$base_url = "http://localhost/proyek-1/";

if (!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
  exit;
}

$userId = $_SESSION['user_id'];
$query = $db->prepare("SELECT u.nama_lengkap, u.nama, u.email, u.telepon, u.alamat, u.foto_profile, d.file_kk, d.file_ktp, d.file_sim
                      FROM users u
                      LEFT JOIN dokumen_user d ON u.id = d.id_user
                      WHERE u.id = ?");
$query->bind_param("i", $userId);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();
$fotoPath = isset($user['foto_profile']) && $user['foto_profile']
  ? "../../uploads/foto_profile/" . $user['foto_profile']
  : "../../assets/image/default.png";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Profile</title>
  <meta name="description" content="" />
  <meta name="keywords" content="" />

  <!-- Favicons -->
  <link href="<?= $base_url ?>assets/image/favicon.jpeg" rel="icon" />
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&family=Inter:wght@600;700&display=swap" rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/aos/aos.css" rel="stylesheet" />
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />

  <!-- Main CSS File -->
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/css/main.css" rel="stylesheet" />

  <style>
    /* Profile Section Styles Scoped */
    .profile-section {
      padding-top: 4rem;
      padding-bottom: 5rem;
      background: transparent;
      font-family: 'Roboto', sans-serif;
      color: #fff;
    }

    .profile-section h1,
    .profile-section h2,
    .profile-section h3 {
      font-family: 'Inter', sans-serif;
      color: #fff;
      font-weight: 700;
      margin-top: 0;
    }

    .profile-section h1 {
      font-size: 3rem;
      font-weight: 800;
      line-height: 1.1;
      margin-bottom: 0.5rem;
    }

    .profile-section h2 {
      font-size: 2rem;
      margin-bottom: 1rem;
    }

    .profile-section h3 {
      font-size: 1.5rem;
      margin-bottom: 1rem;
    }

    /* Profile Hero with two buttons side by side, without profile image */
    .profile-hero {
      text-align: center;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
      padding-bottom: 3rem;
      border-bottom: 1px solid rgba(255 255 255 / 0.15);
      background: transparent;
      box-shadow: none;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1.5rem;
    }

    .profile-avatar {
      width: 140px;
      height: 140px;
      border-radius: 50%;
      object-fit: cover;
      box-shadow: 0 8px 20px rgba(255 255 255 / 0.3);
      margin-bottom: 0;
      background: transparent;
      border: 2px solid #fff;
    }

    .profile-role {
      font-size: 1.25rem;
      font-weight: 600;
      color: #ddd;
      margin-bottom: 1rem;
    }

    .profile-cta {
      margin-top: 0;
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      justify-content: center;
      width: 100%;
      max-width: 300px;
    }

    .btn-primary {
      background-color: #111827;
      color: #fff;
      font-weight: 700;
      font-size: 1rem;
      border: none;
      border-radius: 0.75rem;
      padding: 0.75rem 1.5rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
      text-align: center;
      flex: 1 1 auto;
      min-width: 120px;
    }

    .btn-primary:hover,
    .btn-primary:focus {
      background-color: #374151;
      outline: none;
    }

    .info-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2rem;
      margin-top: 3rem;
      background: transparent;
      color: #fff;
    }

    /* Cards with background and shadow */
    .card {
      background: #374151;
      border-radius: 0.75rem;
      padding: 2rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      display: flex;
      flex-direction: column;
      gap: 1rem;
      transition: box-shadow 0.3s ease;
      color: #fff;
    }

    /* Card text white for Personal Details and Documents */
    .card h3,
    .card label,
    .card div.value {
      color: #fff;
    }

    /* Document card: interactive accordion style */
    .documents-accordion {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      background: transparent;
    }

    .doc-item {
      background: #1f2937;
      /* dark slate */
      border-radius: 0.5rem;
      cursor: pointer;
      padding: 1rem 1.25rem;
      box-shadow: 0 2px 5px rgb(0 0 0 / 0.1);
      transition: box-shadow 0.3s ease;
      color: #e5e7eb;
      /* light gray */
      user-select: none;
    }

    .doc-item:hover {
      box-shadow: 0 5px 15px rgb(0 0 0 / 0.2);
      background: #374151;
    }

    .doc-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-weight: 700;
      font-size: 1.125rem;
      letter-spacing: 0.02em;
    }

    .doc-icon {
      font-size: 1.25rem;
      margin-right: 0.5rem;
      display: inline-flex;
      align-items: center;
    }

    .doc-content {
      margin-top: 0.75rem;
      font-weight: 400;
      font-size: 0.95rem;
      color: #d1d5db;
      /* lighter gray */
      line-height: 1.4;
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.35s ease;
    }

    .doc-item.active .doc-content {
      max-height: 10rem;
      /* enough for content */
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
      background: transparent;
      color: #fff;
    }

    .profile-section label {
      font-weight: 600;
      font-size: 0.875rem;
      color: #ddd;
    }

    .profile-section input,
    .profile-section textarea {
      padding: 0.75rem 1rem;
      border-radius: 0.75rem;
      border: 1px solid #555;
      font-size: 1rem;
      font-family: inherit;
      transition: border-color 0.3s ease;
      resize: vertical;
      background: #222;
      color: #fff;
    }

    .profile-section input::placeholder,
    .profile-section textarea::placeholder {
      color: #aaa;
    }

    .profile-section input:focus,
    .profile-section textarea:focus {
      outline: none;
      border-color: #fff;
      box-shadow: 0 0 0 3px rgba(255 255 255 / 0.3);
      background: #111;
      color: #fff;
    }

    .submit-btn {
      background-color: #111827;
      color: #fff;
      border: none;
      border-radius: 0.75rem;
      font-weight: 700;
      font-size: 1rem;
      padding: 0.75rem 1.5rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .submit-btn:hover,
    .submit-btn:focus {
      background-color: #374151;
      outline: none;
    }

    @media (max-width: 600px) {
      .profile-section h1 {
        font-size: 2.25rem;
      }
    }
  </style>
</head>

<body class="starter-page-page">
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.webp" alt=""> -->
        <h1 class="sitename">Sigma RentCar</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="listing.php">Daftar Mobil</a></li>
          <li class="dropdown"><a href="#"><span>Riwayat</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="riwayat.php" class="active">Riwayat Booking</a></li>
              <li><a href="denda.php">Riwayat Denda</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Akun</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="profile.php" class="active">Profile</a></li>
              <li><a href="#">Status Blacklist</a></li>
              <li><a href="../Halaman_Register&Login/logout.php">LogOut</a></li>
            </ul>
          </li>
          <li><a href="../customer/index.php/#contact">Kontak</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Profile Section Inserted Below Starter Section -->
    <section class="profile-section container" aria-label="User Profile">
      <section class="profile-hero" aria-label="User Profile Introduction">
        <img src="<?= htmlspecialchars($fotoPath) ?>" alt="Foto Profil User" class="profile-avatar" style="width:150px; height:150px; object-fit:cover; border-radius:50%;" />
        <h1 class="profile-name"><?= htmlspecialchars($user['nama_lengkap'] ?? $user['nama']) ?></h1>
        <p class="profile-bio">
          Menjelajah destinasi baru dan mengendarai mobil terbaik kini lebih mudah. Sigma RentCar, solusi sewa mobil yang terpercaya.
        </p>
        <div class="profile-cta">
          <a href="<?= $base_url ?>pages/customer/riwayat.php" class="btn-primary">Riwayat Booking</a>
        </div>
      </section>

      <section class="profile-info" aria-label="User Personal Information">
        <div class="info-cards">
          <article class="card">
            <h3>Personal Details</h3>
            <label>Nama Lengkap</label>
            <div class="value"><?= htmlspecialchars($user['nama_lengkap'] ?? $user['nama']) ?></div>

            <label>Email</label>
            <div class="value"><?= htmlspecialchars($user['email']) ?></div>

            <label>Nomor Telepon</label>
            <div class="value"><?= htmlspecialchars($user['telepon']) ?></div>

            <label>Alamat</label>
            <div class="value"><?= htmlspecialchars($user['alamat']) ?></div>
          </article>

          <article class="card">
            <h3>Dokumen</h3>
            <div class="documents-accordion">
              <div class="doc-item" tabindex="0">
                <div class="doc-header" aria-expanded="false" role="button" aria-controls="doc1-content" id="doc1-header">
                  <span><i class="bi bi-file-earmark-text doc-icon" aria-hidden="true"></i> KK</span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="doc-arrow" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 1.25rem; height: 1.25rem; transition: transform 0.3s;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
                </div>
                <div class="doc-content" id="doc1-content" aria-labelledby="doc1-header" hidden>
                  <img src="../../uploads/dokumen-user/<?= htmlspecialchars($user['file_kk']) ?>" alt="KK" style="width: 100%; border-radius: 8px;">
                </div>
                <p>Dokumen Kartu Keluarga (KK) - Detail atau pratinjau gambar Kartu Keluarga dapat ditampilkan di sini.</p>
              </div>
              <div class="doc-item" tabindex="0">
                <div class="doc-header" aria-expanded="false" role="button" aria-controls="doc2-content" id="doc2-header">
                  <span><i class="bi bi-credit-card doc-icon" aria-hidden="true"></i> KTP</span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="doc-arrow" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 1.25rem; height: 1.25rem; transition: transform 0.3s;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
                </div>
                <div class="doc-content" id="doc2-content" aria-labelledby="doc2-header" hidden>
                  <img src="../../uploads/dokumen-user/<?= htmlspecialchars($user['file_ktp']) ?>" alt="KTP">
                </div>
                <p>Dokumen Kartu Tanda Penduduk (KTP) - Informasi atau pratinjau Kartu Tanda Penduduk akan ditampilkan di sini.</p>
              </div>
              <div class="doc-item" tabindex="0">
                <div class="doc-header" aria-expanded="false" role="button" aria-controls="doc3-content" id="doc3-header">
                  <span><i class="bi bi-clipboard-check doc-icon" aria-hidden="true"></i> SIM</span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="doc-arrow" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 1.25rem; height: 1.25rem; transition: transform 0.3s;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
                </div>
                <div class="doc-content" id="doc3-content" aria-labelledby="doc3-header" hidden>
                  <img src="../../uploads/dokumen-user/<?= htmlspecialchars($user['file_sim']) ?>" alt="SIM">
                </div>
                <p>Dokumen Surat Izin Mengemudi (SIM) - Detail SIM akan ditampilkan di sini, termasuk catatan dan pratinjau gambar jika tersedia.</p>
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

  <script>
    // Smooth scroll to rental history
    document.getElementById('btnRentalHistory').addEventListener('click', function() {
      document.getElementById('rentalHistorySection').scrollIntoView({
        behavior: 'smooth'
      });
    });

    // Document accordion toggle
    document.querySelectorAll('.doc-item .doc-header').forEach(header => {
      header.addEventListener('click', () => {
        const docItem = header.parentElement;
        const content = header.nextElementSibling;
        const isActive = docItem.classList.contains('active');
        if (isActive) {
          docItem.classList.remove('active');
          content.hidden = true;
          header.setAttribute('aria-expanded', 'false');
          header.querySelector('svg').style.transform = 'rotate(0deg)';
        } else {
          docItem.classList.add('active');
          content.hidden = false;
          header.setAttribute('aria-expanded', 'true');
          header.querySelector('svg').style.transform = 'rotate(180deg)';
        }
      });
      // Keyboard accessibility
      header.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          header.click();
        }
      });
    });
  </script>
</body>

</html>