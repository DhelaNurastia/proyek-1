<?php
require_once '../../koneksi.php';

$base_url = "../../";
$db = mysqli_connect(hostname: HOSTNAME, username: USERNAME, password: PASSWORD, database: DATABASE);

$tgl_mulai = $_GET['tanggal_mulai'] ?? '';
$jam_mulai = $_GET['jam_mulai'] ?? '';
$tgl_selesai = $_GET['tanggal_selesai'] ?? '';
$jam_selesai = $_GET['jam_selesai'] ?? '';

$start_datetime = "$tgl_mulai $jam_mulai";
$end_datetime = "$tgl_selesai $jam_selesai";

$mobil_tersedia = [];
$error = '';

if ($tgl_mulai && $jam_mulai && $tgl_selesai && $jam_selesai) {
  if (strtotime($start_datetime) >= strtotime($end_datetime)) {
    $error = "Tanggal dan jam mulai harus lebih awal dari tanggal dan jam selesai.";
  } else {
    $query = "SELECT u.id, j.nama AS unitName, j.harga_sewa AS pricePer12h,
    u.transmisi, j.jumlah_kursi AS seats, u.plat_nomor,
    u.warna, u.status, u.foto
    FROM unit_mobil u
    JOIN jenis_mobil j ON u.jenis_mobil_id = j.id
    WHERE u.id NOT IN (
      SELECT unit_mobil_id FROM booking
      WHERE 
        CONCAT(tgl_booking, ' ', jam_booking) < ?
        AND 
        CONCAT(tgl_kembali, ' ', jam_kembali) > ?
    )
    AND u.is_active = 1";


    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $end_datetime, $start_datetime);
    $stmt->execute();
    $mobil_tersedia = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Katalog</title>
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

  <style>
    /* Car filter section with no background or container box, spaced by margin & padding only */
    .car-filter-section {
      padding-top: 3.5rem;
      padding-bottom: 3.5rem;
      max-width: 1200px;
      margin-left: auto;
      margin-right: auto;
    }

    .car-filter-section h3 {
      font-family: 'Raleway', sans-serif;
      font-weight: 700;
      font-size: 2.5rem;
      margin-bottom: 1.75rem;
      color: #000000;
      /* dark slate gray */
      user-select: none;
    }

    .filter-form {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 1.75rem 2rem;
      margin-bottom: 3rem;
    }

    .filter-form label {
      display: block;
      font-weight: 600;
      color: #4b5563;
      /* neutral gray */
      margin-bottom: 0.3rem;
      font-size: 0.95rem;
      font-family: 'Nunito Sans', sans-serif;
      user-select: none;
    }

    .filter-form input[type='date'],
    .filter-form input[type='time'],
    .filter-form input[type='text'],
    .filter-form select {
      width: 100%;
      padding: 0.6rem 0.9rem;
      border: 1.5px solid #d1d5db;
      border-radius: 0.625rem;
      font-family: 'Nunito Sans', sans-serif;
      font-size: 1rem;
      color: #374151;
      background: #ffffff;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
      box-shadow: inset 0 1px 2px rgb(0 0 0 / 0.07);
      cursor: text;
    }

    .filter-form input[type='date']:focus,
    .filter-form input[type='time']:focus,
    .filter-form input[type='text']:focus,
    .filter-form select:focus {
      outline: none;
      border-color: #2563eb;
      box-shadow: 0 0 6px 3px rgba(37, 99, 235, 0.4);
      background: #ffffff;
      cursor: text;
    }

    /* Car list grid */
    .car-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 1.75rem;
    }

    /* Car cards with subtle shadow and rounded corners only */
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
      transform: translateY(-6px);
      box-shadow: 0 12px 32px rgba(37, 99, 235, 0.3);
      background: #f9fafb;
    }

    .car-card:focus-visible {
      box-shadow: 0 0 0 3px #2563eb;
    }

    .car-card:active {
      transform: translateY(-3px);
      box-shadow: 0 8px 24px rgba(37, 99, 235, 0.4);
    }

    .car-info-row {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
      gap: 0.75rem 1.25rem;
      padding-top: 0.5rem;
      border-top: 1px solid rgba(255, 255, 255, 0.15);
      margin-top: 0.75rem;
      color: white !important;
      font-size: 0.95rem;
    }

    /* Flex container for car info row */


    .car-info-item {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      white-space: nowrap;
    }

    .car-info-item i {
      font-size: 1rem;
      color: #f3f4f6;
      flex-shrink: 0;
    }

    /* For status, different color badges */
    .car-status {
      font-weight: 600;
      padding: 0.15rem 0.6rem;
      border-radius: 9999px;
      text-transform: uppercase;
      font-size: 0.8rem;
      letter-spacing: 0.05em;
      user-select: none;
    }

    .car-status.available {
      background-color: #d1fae5;
      color: #047857;
    }

    .car-status.unavailable {
      background-color: #fee2e2;
      color: #b91c1c;
    }

    .no-results {
      text-align: center;
      font-size: 1.125rem;
      color: #6b7280;
      padding: 3rem 0;
      font-family: 'Nunito Sans', sans-serif;
      user-select: none;
    }

    /* Visually hidden assistive text for accessibility */
    .visually-hidden {
      position: absolute !important;
      height: 1px;
      width: 1px;
      overflow: hidden;
      clip: rect(1px, 1px, 1px, 1px);
      white-space: nowrap;
      border: 0;
      padding: 0;
      margin: -1px;
    }

    .filter-form input[type='submit'],
    .btn-rent {
      font-family: 'Raleway', sans-serif;
      font-weight: 700;
      font-size: 1rem;
      background-color: #2563eb;
      color: #ffffff;
      border: none;
      padding: 0.6rem 1rem;
      border-radius: 0.5rem;
      cursor: pointer;
      align-self: flex-start;
      transition: background-color 0.3s ease;
      user-select: none;
      text-decoration: none;
      display: inline-flex;
      justify-content: center;
      align-items: center;
      gap: 0.4rem;
    }

    .filter-form input[type='submit'],
    .btn-rent:hover,
    .btn-rent:focus {
      background-color: #1e40af;
      outline: none;
      text-decoration: none;
      color: #ffffff;
    }
  </style>

</head>

<body class="starter-page-page">
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div
      class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.webp" alt=""> -->
        <h1 class="sitename">Sigma RentCar</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="listing.php" class="active">Daftar Mobil</a></li>
          <li class="dropdown"><a href="#"><span>Riwayat</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="riwayat.php" class="active">Riwayat Booking</a></li>
              <li><a href="denda.php">Riwayat Denda</a></li>
            </ul>
          <li class="dropdown"><a href="#"><span>Akun</span><i class="bi bi-chevron-down toggle-dropdown"></i></a>
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
        <h1>Temukan Mobil Sewa Terbaik untuk Perjalanan Anda</h1>
        <p>Mulai dari city car hemat BBM hingga SUV untuk liburan keluarga — kami siap menemani setiap perjalanan Anda.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li class="listing.php">Halaman Booking</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- End Page Title -->

    <!-- Car filter and listing start -->
    <section class="car-filter-section" aria-labelledby="carFilterTitle">
      <form id="car-filter-form" class="filter-form" method="get" aria-describedby="carFilterDesc" novalidate>
        <div>
          <label for="pickup-date">Tanggal Peminjaman</label>
          <input type="date" id="pickup-date" name="tanggal_mulai" value="<?= htmlspecialchars($tgl_mulai) ?>" required />
        </div>
        <div>
          <label for="pickup-date">Jam Mulai</label>
          <input type="time" name="jam_mulai" value="<?= htmlspecialchars($jam_mulai) ?>" required>
        </div>
        <div>
          <label for="return-date">Tanggal Pengembalian</label>
          <input type="date" id="return-date" name="tanggal_selesai" value="<?= htmlspecialchars($tgl_selesai) ?>" required />
        </div>
        <div>
          <label for="pickup-date">Jam Selesai</label>
          <input type="time" name="jam_selesai" value="<?= htmlspecialchars($jam_selesai) ?>" required>
        </div>
        <div>
          <button class="btn-rent" type="submit">Cari Mobil</button>
        </div>
      </form>

      <?php if ($error): ?>
        <p style="color:red;"><?= $error ?></p>
      <?php endif; ?>

      <!-- <h2>Hasil Pencarian</h2>
      <?php if (!empty($mobil_tersedia)): ?>
        <ul>
          <?php foreach ($mobil_tersedia as $mobil): ?>
            <li><?= $mobil['plat_nomor'] ?> - <?= $mobil['unitName'] ?> - Rp<?= number_format($mobil['pricePer12h']) ?>/12 jam</li>
          <?php endforeach; ?>
        </ul>
      <?php elseif ($tgl_mulai): ?>
        <p>Tidak ada mobil tersedia di tanggal dan waktu yang dipilih.</p>
      <?php endif; ?> -->
      <h2>Hasil Pencarian</h2>
      <div class="row">
        <?php if (!empty($mobil_tersedia)): ?>
          <?php foreach ($mobil_tersedia as $mobil): ?>
            <?php
            $foto = !empty($mobil['foto']) ? "{$base_url}uploads/foto-mobil/{$mobil['foto']}" : "https://via.placeholder.com/300x200";
            ?>
            <div class="col-md-4 mb-4">
              <div class="car-card">
                <img src="<?= $foto ?>" class="card-img-top" alt="<?= htmlspecialchars($mobil['unitName']) ?>" style="height:200px; object-fit:cover;">
                <div class="card-body">
                  <h5 class="card-title"><?= htmlspecialchars($mobil['unitName']) ?></h5>
                  <p class="car-info-row">
                    <strong>Harga:</strong> Rp<?= number_format($mobil['pricePer12h']) ?>/12 jam<br>
                    <strong>Kursi:</strong> <?= $mobil['seats'] ?> orang<br>
                    <strong>Plat Nomor:</strong> <?= $mobil['plat_nomor'] ?><br>
                    <strong>Transmisi:</strong> <?= $mobil['transmisi'] ?><br>
                    <strong>Warna:</strong> <?= $mobil['warna'] ?>
                  </p>
                  <a href="booking.php?unit=<?= urlencode($mobil['unitName']) ?>&unit_id=<?= $mobil['id'] ?>&tanggal_mulai=<?= $tgl_mulai ?>&jam_mulai=<?= $jam_mulai ?>&tanggal_selesai=<?= $tgl_selesai ?>&jam_selesai=<?= $jam_selesai ?>" class="btn btn-primary w-100">
                    Rental Sekarang
                  </a>

                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php elseif ($tgl_mulai): ?>
          <p>Tidak ada mobil tersedia di tanggal dan waktu yang dipilih.</p>
        <?php endif; ?>
      </div>


      <p id="carFilterDesc" class="visually-hidden">
        Filter daftar mobil berdasarkan tanggal pengambilan & pengembalian, nama unit, dan jenis transmisi.
      </p>

      <div id="car-list" class="car-list" aria-live="polite" aria-relevant="all"></div>
    </section>
    <!-- Car filter and listing end -->
    </div>
    </section>
    <!-- /Starter Section Section -->
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
    const pickupInput = document.getElementById('pickup-date');
    const returnInput = document.getElementById('return-date');
    const todayStr = new Date().toISOString().split('T')[0];
    pickupInput.min = todayStr;
    returnInput.min = todayStr;

    pickupInput.addEventListener('change', () => {
      returnInput.min = pickupInput.value;
      if (returnInput.value < pickupInput.value) {
        returnInput.value = pickupInput.value;
      }
    });


    const cars = <?= json_encode($mobil_tersedia) ?>;
    const baseURL = <?= json_encode($base_url) ?>;

    console.log(cars[0].id);

    function formatCurrency(value) {
      return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
      }).format(value);
    }


    const unitNameInput = document.getElementById('unit-name');
    const transmissionSelect = document.getElementById('transmission');
    const carListContainer = document.getElementById('car-list');

    // const todayStr = new Date().toISOString().split('T')[0];
    // pickupInput.min = todayStr;
    // returnInput.min = todayStr;
    // pickupInput.value = todayStr;
    // returnInput.value = todayStr;

    pickupInput.addEventListener('change', () => {
      returnInput.min = pickupInput.value;
      if (returnInput.value < pickupInput.value) {
        returnInput.value = pickupInput.value;
      }
    });

    cars.forEach(car => {
      const today = new Date();
      const future = new Date();
      future.setDate(today.getDate() + 60);
      car.availableFrom = today.toISOString().split("T")[0];
      car.availableTo = future.toISOString().split("T")[0];
    });

    function filterCars() {
      const pickupDate = pickupInput.value;
      const returnDate = returnInput.value;
      const unitName = unitNameInput.value.trim().toLowerCase();
      const transmission = transmissionSelect.value;

      let filtered = cars;

      // Pastikan tanggal pengembalian lebih besar dari tanggal pengambilan
      if (pickupDate && returnDate && pickupDate >= returnDate) {
        carListContainer.innerHTML = `<p class="no-results">Tanggal pengembalian harus setelah tanggal pengambilan.</p>`;
        return;
      }

      // Hanya filter berdasarkan tanggal jika kedua tanggal diisi
      if (pickupDate && returnDate) {
        filtered = filtered.filter(car => {
          const carStart = new Date(car.availableFrom);
          const carEnd = new Date(car.availableTo);
          const pick = new Date(pickupDate);
          const ret = new Date(returnDate);

          return carStart <= pick && carEnd >= ret;
        });
      }

      // Filter berdasarkan nama unit
      if (unitName) {
        filtered = filtered.filter(car => car.unitName.toLowerCase().includes(unitName));
      }

      // Filter berdasarkan transmisi
      if (transmission !== 'all') {
        filtered = filtered.filter(car => car.transmisi === transmission);
      }

      // Menampilkan hasil mobil yang sesuai dengan filter
      if (filtered.length === 0) {
        carListContainer.innerHTML = `<p class="no-results">Mobil tidak ditemukan.</p>`;
        return;
      }

      // Render mobil yang sudah difilter
      carListContainer.innerHTML = filtered.map(car => {
        const fotoUrl = car.foto && car.foto.trim() !== '' ?
          `${baseURL}uploads/foto-mobil/${car.foto}` :
          'https://via.placeholder.com/300x200';

        return `
            <article class="car-card" tabindex="0">
                <img src="${fotoUrl}" alt="${car.unitName}" style="width:100%; border-radius: 0.5rem; margin-bottom: 1rem; object-fit: cover; height: 180px;">
                <h4 class="car-name">${car.unitName}</h4>
                <div class="car-info-row">
                    <div class="car-info-item"><i class="bi bi-cash-coin"></i><span>${formatCurrency(car.pricePer12h)}</span></div>
                    <div class="car-info-item"><i class="bi bi-gear"></i><span>${car.transmisi}</span></div>
                    <div class="car-info-item"><i class="bi bi-people"></i><span>${car.seats} seats</span></div>
                    <div class="car-info-item"><i class="bi bi-card-text"></i><span>${car.plat_nomor}</span></div>
                    <div class="car-info-item"><i class="bi bi-palette"></i><span>${car.warna}</span></div>
                    <div class="car-info-item"><span class="car-status available">Available</span></div>
                </div>
                <button class="btn-rent" type="button" onclick="window.location.href='booking.php?unit=${car.unitName}&unit_id=${car.id}'" aria-label="Rental sekarang ${car.unitName}">
                Rental Sekarang <i class="bi bi-arrow-right"></i>
              </button>
            </article>
        `;
      }).join('');
    }

    [pickupInput, returnInput, unitNameInput, transmissionSelect].forEach(el => {
      el.addEventListener('input', filterCars);
    });

    filterCars();
  </script>
</body>

</html>