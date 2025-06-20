<?php
session_start();
$base_url = '/proyek-1/';
$koneksi = new mysqli("localhost", "root", "", "proyek-1");

if ($koneksi->connect_error) {
  die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil id customer dari session
$id_customer = $_SESSION['user_id'];

// Query dengan filter sesuai id_customer
$sql = "
    SELECT 
        booking.id,
        jenis_mobil.nama AS nama_mobil,
        booking.tgl_booking,
        booking.jam_booking,
        booking.tgl_kembali,
        booking.jam_kembali,
        booking.total_biaya,
        booking.status AS status_booking,
        pembayaran.status AS status_pembayaran
    FROM booking
    JOIN unit_mobil ON booking.unit_mobil_id = unit_mobil.id
    JOIN jenis_mobil ON unit_mobil.jenis_mobil_id = jenis_mobil.id
    LEFT JOIN pembayaran ON booking.id = pembayaran.booking_id
    WHERE booking.customer_id = $id_customer
    ORDER BY booking.tgl_booking DESC
";

$result = $koneksi->query($sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Riwayat Booking</title>
  <meta name="description" content="" />
  <meta name="keywords" content="" />

  <!-- Favicons -->
  <link href="<?= $base_url ?>assets/image/favicon.jpeg" rel="icon" />
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/aos/aos.css" rel="stylesheet" />
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />

  <!-- Main CSS File -->
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/css/main.css" rel="stylesheet" />

  <!-- =======================================================
  * Template Name: Strategy
  * Template URL: https://bootstrapmade.com/strategy-bootstrap-agency-template/
  * Updated: May 09 2025 with Bootstrap v5.3.6
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    /* Booking History Styles */
    .booking-history {
      background-color: transparent !important;
      padding-top: 4rem;
      padding-bottom: 4rem;
      color: #000000;
      font-feature-settings: "tnum";
      /* tabular numbers for cost */
    }

    .table-responsive {
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }

    table.booking-table {
      font-size: 0.85rem;
    }

    .booking-history h2 {
      font-weight: 700;
      font-size: 2.5rem;
      color: #000000;
      margin-bottom: 2rem;
      text-align: center;
    }

    table.booking-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 2rem;
      font-size: 1rem;
      color: #000000 !important;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      border-radius: 0.75rem;
      overflow: hidden;
    }

    table.booking-table thead tr {
      background-color: #111827;
      text-align: left;
      border-bottom: 2px solid #e5e7eb;
    }

    table.booking-table thead th {
      padding: 1rem 1.5rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: #000000;
      user-select: none;
    }

    table.booking-table tbody tr {
      background-color: #374151;
      border-bottom: 1px solid #e5e7eb;
      transition: background-color 0.3s ease;
    }

    table.booking-table tbody tr:hover {
      background-color: #e0e7ff;
    }

    table.booking-table tbody td {
      padding: 1rem 1.5rem;
      vertical-align: middle;
      border-right: 1px solid #e5e7eb;
      font-variant-numeric: tabular-nums;
    }

    table.booking-table tbody td:last-child {
      border-right: none;
    }

    .booking-status {
      padding: 0.25rem 0.75rem;
      border-radius: 0.5rem;
      font-weight: 700;
      font-size: 0.9rem;
      display: inline-block;
      text-transform: capitalize;
      user-select: none;
      min-width: 85px;
      text-align: center;
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

    @media (max-width: 576px) {

      table.booking-table thead th,
      table.booking-table tbody td {
        padding: 0.5rem 0.75rem;
        font-size: 0.9rem;
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
        <h1 class="sitename">Sigma RentCar<h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="listing.php">Daftar Mobil</a></li>
          <li class="dropdown"><a href="#" class="active"><span>Riwayat</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="riwayat.php">Riwayat Booking</a></li>
              <li><a href="denda.php">Riwayat Denda</a></li>
            </ul>
          <li class="dropdown"><a href="#"><span>Akun</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="../Halaman_Register&Login/logout.php">LogOut</a></li>
            </ul>
          </li>
          <li><a href="pages/customer/index.php/#contact">Kontak</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <main class="main">
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade">
      <div class="container position-relative">
        <h1>Riwayat Booking</h1>
        <p>Lihat riwayat pemesanan mobil Anda secara lengkap dan terperinci di halaman ini.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Riwayat Booking</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- End Page Title -->

    <!-- Booking History Section -->
    <section
      id="booking-history"
      class="booking-history"
      aria-label="Booking History section">
      <div class="container">
        <div class="table-responsive">
          <table class="booking-table"
            aria-describedby="bookingHistoryDesc"
            role="table">
            <caption id="bookingHistoryDesc" class="visually-hidden">Table listing all booking history entries</caption>
            <thead>
              <tr>
                <th scope="col">ID Booking</th>
                <th scope="col">Nama Unit</th>
                <th scope="col">Tgl Pengambilan</th>
                <th scope="col">Jam Pengambilan</th>
                <th scope="col">Tgl Pengembalian</th>
                <th scope="col">Jam Pengembalian</th>
                <th scope="col">Total Biaya</th>
                <th scope="col">Status Pembayaran</th>
                <th scope="col">Status Booking</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>

            <tbody id="booking-table-body">
              <?php
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>"; // <-- tambahkan baris ini

                  echo "<td>#BK" . str_pad($row['id'], 8, '0', STR_PAD_LEFT) . "</td>";
                  echo "<td>" . htmlspecialchars($row['nama_mobil']) . "</td>";
                  echo "<td>" . date('d-m-Y', strtotime($row['tgl_booking'])) . "</td>";
                  echo "<td>" . date('H:i', strtotime($row['jam_booking'])) . "</td>";
                  echo "<td>" . date('d-m-Y', strtotime($row['tgl_kembali'])) . "</td>";
                  echo "<td>" . date('H:i', strtotime($row['jam_kembali'])) . "</td>";
                  echo "<td>Rp " . number_format($row['total_biaya'], 0, ',', '.') . "</td>";

                  // Status Pembayaran
                  $status_pembayaran = $row['status_pembayaran'] == 'berhasil' ? 'Confirmed' : 'Pending';
                  $statusClassPembayaran = $row['status_pembayaran'] == 'berhasil' ? 'status-confirmed' : 'status-pending';
                  echo "<td><span class='booking-status $statusClassPembayaran'>$status_pembayaran</span></td>";

                  // Status Booking
                  $status_booking = $row['status_booking'];
                  $statusClassBooking = match ($status_booking) {
                    'pending' => 'status-pending',
                    'confirmed', 'on_rent', 'completed' => 'status-confirmed',
                    'rejected', 'cancelled' => 'status-canceled',
                    default => 'status-pending'
                  };
                  echo "<td><span class='booking-status $statusClassBooking'>" . ucfirst($status_booking) . "</span></td>";

                  // Aksi
                  echo "<td>";
                  if ($status_booking == 'pending') {
                    echo "<button class='btn btn-danger btn-sm' onclick='confirmCancel(" . $row['id'] . ")'>Batalkan</button>";
                  } else {
                    echo "-";
                  }
                  echo "</td>";

                  echo "</tr>"; // penutup <tr> tetap
                }
              } else {
                echo "<tr><td colspan='8'>Tidak ada data booking</td></tr>";
              }
              ?>
            </tbody>

          </table>
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
  <a
    href="#"
    id="scroll-top"
    class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
    function confirmCancel(id) {
      if (confirm("Apakah kamu yakin ingin membatalkan booking ini?")) {
        window.location.href = "batalkan_booking.php?id=" + id;
      }
    }
  </script>
</body>

</html>