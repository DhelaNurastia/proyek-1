<?php
session_start();
require_once '../../koneksi.php';
$base_url = '/proyek-1/';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
  exit;
}

$userId = $_SESSION['user_id'];
$query = $db->prepare("SELECT u.nama_lengkap, u.nama, u.email, u.telepon, u.alamat, u.foto_profile, d.file_kk, d.file_ktp, d.file_sim, u.blacklist
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
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Profile</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="<?= $base_url ?>assets/image/favicon.jpeg" rel="icon">
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- Material Icons for consistent iconography -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/css/main.css" rel="stylesheet">

  <style>
    /* Profile Section Styling */
    #profile-section {
      padding: 40px 0 60px;
      max-width: 1080px;
      margin: 0 auto;
    }

    #profile-section .profile-card {
      background: rgba(255, 255, 255, 0.14);
      backdrop-filter: blur(20px);
      border-radius: 1rem;
      box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.12);
      padding: 2rem;
      transition: box-shadow 0.3s ease;
    }

    #profile-section .profile-card:hover,
    #profile-section .profile-card:focus-within {
      box-shadow: 0 16px 48px 0 rgba(0, 0, 0, 0.25);
    }

    #profile-section h2 {
      font-weight: 700;
      font-size: clamp(1.8rem, 2vw, 2.5rem);
      margin-bottom: 1.2rem;
      color: #00000;
    }

    #profile-section .status-badge {
      display: flex;
      /* ubah dari inline-flex agar bisa full width */
      align-items: center;
      justify-content: center;
      /* agar teks tetap di tengah */
      gap: 6px;
      font-weight: 600;
      font-size: 0.9rem;
      padding: 10px 16px;
      border-radius: 12px;
      color: white;
      user-select: none;
      width: 100%;
      /* ini membuat elemen memenuhi seluruh lebar parent */
    }

    #profile-section .status-active {
      background: #22c55e;
      /* Green */
      box-shadow: 0 0 8px #22c55e;
    }

    #profile-section .status-inactive {
      background: #ef4444;
      /* Red */
      box-shadow: 0 0 8px #ef4444;
    }

    #profile-section .profile-info {
      margin-top: 24px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1.6rem 3rem;
      color: #00000;
      font-family: 'Nunito Sans', sans-serif;
    }

    #profile-section .profile-info-item {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: clamp(1rem, 1vw, 1.1rem);
    }

    #profile-section .profile-info-item .material-icons {
      font-size: 24px;
      color: #6366f1;
      /* Indigo-500 */
    }

    #profile-section .documents {
      margin-top: 2.5rem;
    }

    #profile-section .documents h3 {
      font-weight: 600;
      margin-bottom: 1rem;
      color: #00000;
      font-size: clamp(1.4rem, 1.8vw, 1.6rem);
    }

    #profile-section .doc-list {
      display: flex;
      flex-wrap: wrap;
      gap: 1.6rem;
    }

    #profile-section .doc-card {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 1rem;
      box-shadow: 0 6px 18px rgb(0 0 0 / 0.1);
      width: 160px;
      cursor: pointer;
      transition: transform 0.25s ease, box-shadow 0.3s ease;
      text-align: center;
      padding: 1rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      user-select: none;
    }

    #profile-section .doc-card:hover,
    #profile-section .doc-card:focus-visible {
      transform: translateY(-6px);
      box-shadow: 0 12px 36px rgba(0, 0, 0, 0.22);
      outline: none;
    }

    #profile-section .doc-card img {
      max-width: 100%;
      border-radius: 0.75rem;
      margin-bottom: 0.8rem;
      user-select: none;
      pointer-events: none;
      aspect-ratio: 4 / 3;
      object-fit: cover;
      box-shadow: 0 3px 8px rgb(0 0 0 / 0.1);
      border: 1px solid rgba(0, 0, 0, 0.12);
    }

    #profile-section .doc-card .doc-label {
      font-weight: 600;
      font-size: 1rem;
      color: #00000;
    }

    /* Responsive adjustments */
    @media (max-width: 767px) {
      #profile-section .profile-info {
        grid-template-columns: 1fr;
        gap: 1.2rem 0;
      }

      #profile-section .doc-list {
        justify-content: center;
      }
    }

    /* Modal Styles */
    #doc-modal {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100dvh;
      display: none;
      align-items: center;
      justify-content: center;
      background: rgba(30, 41, 59, 0.85);
      backdrop-filter: blur(12px);
      z-index: 1050;
      padding: 1rem;
      overflow-y: auto;
      will-change: opacity;
      transition: opacity 0.3s ease;
    }

    #doc-modal.show {
      display: flex;
      opacity: 1;
    }

    #doc-modal .modal-content {
      position: relative;
      width: 100%;
      max-width: 720px;
      /* atau sesuaikan dengan keinginanmu */
      max-height: 90vh;
      background: rgba(255 255 255 / 0.15);
      border-radius: 1rem;
      backdrop-filter: blur(24px);
      box-shadow: 0 24px 48px rgb(0 0 0 / 0.3);
      padding: 1.5rem;
      cursor: default;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }


    #doc-modal .modal-image {
      max-width: 100%;
      max-height: 80vh;
      border-radius: 1rem;
      object-fit: contain;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
      user-select: none;
    }

    #doc-modal .modal-close-button {
      position: absolute;
      top: 12px;
      right: 12px;
      background: rgba(0, 0, 0, 0.3);
      border: none;
      border-radius: 50%;
      color: white;
      width: 36px;
      height: 36px;
      font-size: 24px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background-color 0.2s ease;
    }

    #doc-modal .modal-close-button:hover,
    #doc-modal .modal-close-button:focus {
      background: rgba(0, 0, 0, 0.6);
      outline: none;
    }

    /* Prevent background scroll when modal is open */
    body.modal-open {
      overflow: hidden;
    }

    .status-badge {
      padding: 8px 16px;
      border-radius: 25px;
      font-weight: bold;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .status-active {
      background-color: #22c55e;
      color: white;
    }

    .status-blacklist {
      background-color: #ef4444;
      color: white;
    }

    /* Tombol edit profile */
    .edit-btn {
      padding: 15px 30px;
      background: #0056b3;
      color: white;
      border: none;
      border-radius: 50px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      overflow: hidden;
      transition: all 0.3s ease;
      box-shadow: 0 5px 15px #0056b3(255, 154, 158, 0.4);
      display: inline-block;
      justify-content: center;
      align-items: center;
    }


    .edit-btn:hover {
      background-color: #0056b3;
    }

    .edit-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px #0056b3(255, 154, 158, 0.6);
    }

    .edit-btn:active {
      transform: translateY(1px);
    }

    .edit-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(45deg,rgb(61, 108, 159) 0%, #0056b3 99%, #0056b3 100%);
      z-index: -1;
      opacity: 0;
      transition: opacity 0.3s ease;
    }



    .edit-btn:hover::before {
      opacity: 1;
    }

    /* Efek ripple */
    .edit-btn::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 5px;
      height: 5px;
      background: rgba(255, 255, 255, 0.5);
      opacity: 0;
      border-radius: 100%;
      transform: scale(1, 1) translate(-50%);
      transform-origin: 50% 50%;
    }

    .edit-btn:focus:not(:active)::after {
      animation: ripple 1s ease-out;
    }

    @keyframes ripple {
      0% {
        transform: scale(0, 0);
        opacity: 0.5;
      }

      100% {
        transform: scale(20, 20);
        opacity: 0;
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
          <li><a href="index.php">Home</a></li>
          <li><a href="listing.php">Daftar Mobil</a></li>
          <li class="dropdown"><a href="#"><span>Riwayat</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="riwayat.php" class="active">Riwayat Booking</a></li>
              <li><a href="denda.php">Riwayat Denda</a></li>
            </ul>
          <li class="dropdown"><a href="#" class="active"><span>Akun</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="profile.php">Profile</a></li>
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

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade">
      <div class="container position-relative">
        <h1>Profile</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Starter Page</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Button edit profile -->
     <br>
    <div style="text-align: center;">
      <a href="edit_profile.php" class="edit-btn" id="editProfileBtn">Edit Profile</a>
    </div>

    <!-- Profile Section -->
    <section id="profile-section" class="section" aria-label="User profile information">
      <div class="profile-card" tabindex="0" data-aos="fade-up" aria-live="polite" aria-atomic="true" aria-relevant="additions">
        <h3>Detail Profile</h3>
        <div class="profile-info" role="list">
          <div class="profile-info-item" role="listitem">
            <span class="material-icons" aria-hidden="true">person</span>
            <div class="value"><?= htmlspecialchars($user['nama_lengkap'] ?? $user['nama']) ?></div>
          </div>
          <div class="profile-info-item" role="listitem">
            <span class="material-icons" aria-hidden="true">email</span>
            <div class="value"><?= htmlspecialchars($user['email']) ?></div>
          </div>
          <div class="profile-info-item" role="listitem">
            <span class="material-icons" aria-hidden="true">phone</span>
            <div class="value"><?= htmlspecialchars($user['telepon']) ?></div>
          </div>
          <div class="profile-info-item" role="listitem">
            <span class="material-icons" aria-hidden="true">location_on</span>
            <div class="value"><?= htmlspecialchars($user['alamat']) ?></div>
          </div>
          <?php if ($user['blacklist'] == 1): ?>
            <a href="blacklist.php" style="text-decoration: none;">
              <span class="status-badge status-blacklist">
                <span class="material-icons">block</span> Terblacklist
              </span>
            </a>
          <?php else: ?>
            <span class="status-badge status-active">
              <span class="material-icons">check_circle</span> Active
            </span>
          <?php endif; ?>
        </div>

        <div class="documents" aria-label="User documents">
          <h3>Documents</h3>
          <div class="doc-list" role="list" aria-live="polite" aria-atomic="false" aria-relevant="additions removals">
            <?php if (!empty($user['file_kk'])): ?>
              <a href="javascript:void(0)" class="doc-card" role="listitem" data-img-src="../../uploads/dokumen-user/<?= $user['file_kk'] ?>">
                <img src="../../uploads/dokumen-user/<?= $user['file_kk'] ?>" alt="Kartu Keluarga">
                <span class="doc-label">Kartu Keluarga (KK)</span>
              </a>
            <?php endif; ?>

            <?php if (!empty($user['file_ktp'])): ?>
              <a href="javascript:void(0)" class="doc-card" role="listitem" data-img-src="../../uploads/dokumen-user/<?= $user['file_ktp'] ?>">
                <img src="../../uploads/dokumen-user/<?= $user['file_ktp'] ?>" alt="Kartu Tanda Penduduk">
                <span class="doc-label">Kartu Tanda Penduduk (KTP)</span>
              </a>
            <?php endif; ?>

            <?php if (!empty($user['file_sim'])): ?>
              <a href="javascript:void(0)" class="doc-card" role="listitem" data-img-src="../../uploads/dokumen-user/<?= $user['file_sim'] ?>">
                <img src="../../uploads/dokumen-user/<?= $user['file_sim'] ?>" alt="Surat Izin Mengemudi">
                <span class="doc-label">Surat Izin Mengemudi (SIM)</span>
              </a>
            <?php endif; ?>
          </div>
        </div>

      </div>
      </div>
    </section>

    <!-- Document Modal -->
    <div id="doc-modal" role="dialog" aria-modal="true" aria-labelledby="doc-modal-title" aria-describedby="doc-modal-desc" tabindex="-1">
      <div class="modal-content">
        <button class="modal-close-button" aria-label="Close document preview" title="Close document preview">
          <span class="material-icons" aria-hidden="true">close</span>
        </button>
        <img src="" alt="" class="modal-image" />
      </div>
    </div>

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

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const docList = document.querySelector('#profile-section .doc-list');
      const modal = document.getElementById('doc-modal');
      const modalImage = modal.querySelector('.modal-image');
      const closeBtn = modal.querySelector('.modal-close-button');

      if (!docList) return;

      docList.addEventListener('click', (e) => {
        const anchor = e.target.closest('a.doc-card');
        if (!anchor) return;
        e.preventDefault();

        const imgSrc = anchor.dataset.imgSrc;
        const imgAlt = anchor.querySelector('.doc-label')?.textContent + ' enlarged preview';
        if (imgSrc) {
          modalImage.src = imgSrc;
          modalImage.alt = imgAlt;
          modal.classList.add('show');
          document.body.classList.add('modal-open');
          modal.focus();
        }
      });

      function closeModal() {
        modal.classList.remove('show');
        document.body.classList.remove('modal-open');
        modalImage.src = '';
        modalImage.alt = '';
      }

      closeBtn.addEventListener('click', closeModal);
      modal.addEventListener('click', (e) => {
        if (e.target === modal) {
          closeModal();
        }
      });
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.classList.contains('show')) {
          closeModal();
        }
      });
    });
  </script>


</body>

</html>