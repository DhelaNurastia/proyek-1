<?php
include '../../koneksi.php';
$riwayat = mysqli_query($db, "
    SELECT i.*, u.plat_nomor 
    FROM inspeksi i
    JOIN booking b ON i.booking_id = b.id
    JOIN unit_mobil u ON b.unit_mobil_id = u.id
    ORDER BY i.id DESC
");


if (mysqli_num_rows($riwayat) === 0) {
  echo "<p style='color:red;'>⚠️ Tidak ada data inspeksi ditemukan.</p>";
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Riwayat Pemeriksaan</title>
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
            <li class="nav-item"><a href="index.php" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a></li>
            <li class="nav-item"><a href="riwayat.php" class="nav-link active"><i class="nav-icon fas fa-clock"></i>
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
      <h3>Riwayat Pemeriksaan Mobil</h3>
      <div class="card">
        <div class="card-body table-responsive">
          <table class="table table-bordered table-hover">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Plat Nomor</th>
                <th>Pre - Tanggal</th>
                <th>Pre - Kondisi</th>
                <th>Pre - Foto</th>
                <th>Post - Tanggal</th>
                <th>Post - Kondisi</th>
                <th>Post - Foto</th>
                <th>Catatan</th>
                <th>Denda (Rp)</th>
                <th>Edit</th>

              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              while ($r = mysqli_fetch_assoc($riwayat)) { ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $r['plat_nomor'] ?></td>
                  <td><?= $r['tanggal_pre'] ?? '-' ?></td>
                  <td><?= $r['kondisi_pre'] ?? '-' ?></td>
                  <td>
                    <?php if ($r['foto_pre']) { ?>
                      <img src="../../uploads/foto_pre_post/<?= $r['foto_post'] ?>" width="100">

                    <?php } else {
                      echo '-';
                    } ?>
                  </td>
                  <td><?= $r['tanggal_post'] ?? '-' ?></td>
                  <td><?= $r['kondisi_post'] ?? '-' ?></td>
                  <td>
                    <?php if ($r['foto_post']) { ?>
                      <img src="../../uploads/foto_pre_post/<?= $r['foto_post'] ?>" width="100">
                    <?php } else {
                      echo '-';
                    } ?>
                  </td>
                  <td><?= $r['catatan'] ?: '-' ?></td>
                  <td><?= number_format($r['denda'], 0, ',', '.') ?></td>
                  <td>
                    <!-- Tombol Edit -->
                    <a href="edit.php?id=<?= $r['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>