<?php
session_start();
include '../../koneksi.php';

$base_url = '/proyek-1/';

// Jika form disubmit (POST), baru proses
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Validasi input
  if (!isset($_POST['booking_id'], $_POST['kondisi'], $_FILES['foto'])) {
    die("Data tidak lengkap");
  }

  $booking_id = $_POST['booking_id'];
  $tipe       = $_POST['tipe']; // pre atau post
  $kondisi    = $_POST['kondisi'];
  $catatan    = $_POST['catatan'] ?? '';
  $denda      = isset($_POST['denda']) ? (int)$_POST['denda'] : 0;

  $folder = __DIR__ . '/../../../uploads/foto_pre_post/';
  if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
  }

  // Proses upload foto
  $foto       = $_FILES['foto'];
  $nama_file  = $tipe . '_' . time() . '_' . basename($foto['name']);
  $path_file  = $folder . $nama_file;

  if (!move_uploaded_file($foto['tmp_name'], $path_file)) {
    die("Gagal upload file");
  }

  // Cek apakah data inspeksi sudah ada
  $cek = mysqli_query($db, "SELECT * FROM inspeksi WHERE booking_id = $booking_id");

  if (mysqli_num_rows($cek) > 0) {
    if ($tipe === 'post') {
      $query = "UPDATE inspeksi SET 
                        tanggal_post = NOW(),
                        kondisi_post = '$kondisi',
                        catatan = '$catatan',
                        denda = $denda,
                        foto_post = '$nama_file'
                      WHERE booking_id = $booking_id";
    } else {
      die("Inspeksi awal sudah dilakukan.");
    }
  } else {
    if ($tipe === 'pre') {
      $query = "INSERT INTO inspeksi (
                        booking_id, tanggal_pre, kondisi_pre, foto_pre
                      ) VALUES (
                        $booking_id, NOW(), '$kondisi', '$nama_file'
                      )";
    } else {
      die("Harus lakukan pemeriksaan awal dulu.");
    }
  }

  if (mysqli_query($db, $query)) {
    header("Location: index.php?success=1");
    exit;
  } else {
    echo "Gagal menyimpan data: " . mysqli_error($db);
  }
}

// Hanya dijalankan kalau belum POST
// Ambil semua booking yang disetujui
$bookings = mysqli_query($db, "
  SELECT b.id, u.plat_nomor, u.warna, jm.nama AS nama_mobil, c.nama_lengkap
  FROM booking b
  JOIN unit_mobil u ON b.unit_mobil_id = u.id
  JOIN jenis_mobil jm ON u.jenis_mobil_id = jm.id
  JOIN users c ON b.customer_id = c.id
  WHERE b.status = 'confirmed'
");

// Ambil data inspeksi yang sudah ada
$inspeksi_data = [];
$cek_inspeksi = mysqli_query($db, "SELECT booking_id, foto_pre, foto_post FROM inspeksi");
while ($row = mysqli_fetch_assoc($cek_inspeksi)) {
  $inspeksi_data[$row['booking_id']] = $row;
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Dashboard Checker</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
      </ul>
      <span class="ml-3 font-weight-bold">Checker Panel</span>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="#" class="brand-link text-center">
        <span class="brand-text font-weight-light">SIGMA RENTCAR</span>
      </a>
      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column">
            <li class="nav-item"><a href="index.php" class="nav-link active"><i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a></li>
            <li class="nav-item"><a href="riwayat.php" class="nav-link"><i class="nav-icon fas fa-clock"></i>
                <p>Riwayat Pemeriksaan</p>
              </a></li>
            <li class="nav-item"><a href="../Halaman_Register&Login/logout.php" class="nav-link"><i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </a></li>
          </ul>
        </nav>
      </div>
    </aside>

    <div class="content-wrapper p-4">
      <h3>Dashboard Checker</h3>

      <div class="card">
        <div class="card-header bg-primary text-white">
          Form Input Pemeriksaan Mobil
        </div>
        <div class="card-body">
          <form action="proses/proses_upload.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label>ID Booking:</label>
              <select name="booking_id" id="booking_id" class="form-control" required onchange="setFormTipe()">
                <option value="">-- Pilih Booking --</option>
                <?php while ($b = mysqli_fetch_assoc($bookings)) {
                  $id = $b['id'];
                  $pre_done = isset($inspeksi_data[$id]) && $inspeksi_data[$id]['foto_pre'];
                  $post_done = isset($inspeksi_data[$id]) && $inspeksi_data[$id]['foto_post'];
                  $status = $post_done ? '✔️ selesai' : ($pre_done ? '→ lanjut post' : '⬅️ input pre');
                ?>
                  <option value="<?= $id ?>" data-pre="<?= $pre_done ? '1' : '0' ?>" data-post="<?= $post_done ? '1' : '0' ?>">
                    #<?= $id ?> - <?= $b['nama_lengkap'] ?> | <?= $b['nama_mobil'] ?> (<?= $b['warna'] ?>) - <?= $b['plat_nomor'] ?> (<?= $status ?>)
                  </option>
                <?php } ?>
              </select>
            </div>

            <input type="hidden" name="tipe" id="tipe" value="pre">

            <div class="mb-3">
              <label id="label_kondisi">Kondisi Awal:</label>
              <select name="kondisi" class="form-control">
                <option value="normal">Normal</option>
                <option value="rusak">Rusak</option>
              </select>
            </div>

            <div class="mb-3">
              <label id="label_catatan">Catatan (opsional):</label>
              <textarea name="catatan" class="form-control"></textarea>
            </div>

            <div class="mb-3" id="denda_field" style="display: none;">
              <label>Denda (Rp):</label>
              <input type="number" name="denda" class="form-control" value="0">
            </div>

            <div class="mb-3">
              <label id="label_foto">Upload Foto Awal:</label>
              <input type="file" name="foto" class="form-control" accept="image/*" onchange="previewImage(this)" required>
              <img id="preview" src="#" alt="Preview Gambar" class="mt-2" style="display:none; max-width:200px;">
            </div>

            <button type="submit" class="btn btn-success">Simpan Pemeriksaan</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
  <script>
    function previewImage(input) {
      const preview = document.getElementById('preview');
      const file = input.files[0];
      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      } else {
        preview.style.display = 'none';
      }
    }

    function setFormTipe() {
      const select = document.getElementById("booking_id");
      const selected = select.options[select.selectedIndex];

      const pre = selected.getAttribute('data-pre') === '1';
      const post = selected.getAttribute('data-post') === '1';

      const tipeInput = document.getElementById("tipe");
      const labelKondisi = document.getElementById("label_kondisi");
      const labelFoto = document.getElementById("label_foto");
      const dendaField = document.getElementById("denda_field");

      if (!pre) {
        tipeInput.value = "pre";
        labelKondisi.innerText = "Kondisi Awal:";
        labelFoto.innerText = "Upload Foto Awal:";
        dendaField.style.display = "none";
      } else {
        tipeInput.value = "post";
        labelKondisi.innerText = "Kondisi Akhir:";
        labelFoto.innerText = "Upload Foto Akhir:";
        dendaField.style.display = "block";
      }
    }
  </script>
</body>

</html>