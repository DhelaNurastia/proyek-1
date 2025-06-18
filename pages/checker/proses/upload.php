<?php
include '../../koneksi.php';

// Ambil daftar booking
$data_booking = mysqli_query($db, "SELECT b.id, u.plat_nomor FROM booking b
    JOIN unit_mobil u ON b.unit_mobil_id = u.id
    WHERE b.status = 'disetujui'");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Form Pemeriksaan Mobil</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h2 class="mb-4">Form Pemeriksaan Mobil</h2>

  <form action="proses/proses_upload.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="booking_id" class="form-label">ID Booking:</label>
      <select name="booking_id" id="booking_id" class="form-select" required>
        <option value="">-- Pilih Booking --</option>
        <?php while ($row = mysqli_fetch_assoc($data_booking)) { ?>
          <option value="<?= $row['id'] ?>">Booking #<?= $row['id'] ?> - <?= $row['plat_nomor'] ?></option>
        <?php } ?>
      </select>
    </div>


    <div class="mb-3">
      <label for="kondisi" class="form-label">Kondisi Mobil:</label>
      <select name="kondisi" id="kondisi" class="form-select" required>
        <option value="normal">Normal</option>
        <option value="rusak">Rusak</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="catatan" class="form-label">Rincian Kerusakan:</label>
      <textarea name="catatan" id="catatan" class="form-control" placeholder="Contoh: Baret kanan, spion lepas..."></textarea>
    </div>

    <div class="mb-3">
      <label for="denda" class="form-label">Denda (Rp):</label>
      <input type="number" name="denda" id="denda" class="form-control" value="0">
    </div>

    <div class="mb-3">
      <label for="foto" class="form-label">Upload Foto Bukti Kerusakan / Dokumentasi:</label>
      <input type="file" name="foto" id="foto" class="form-control" accept="image/*" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan Pemeriksaan</button>
  </form>
</body>
</html>
