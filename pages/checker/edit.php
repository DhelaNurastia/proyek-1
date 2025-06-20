<?php
include '../../koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data inspeksi yang ingin diedit
$query = mysqli_query($db, "SELECT i.*, u.plat_nomor FROM inspeksi i
JOIN booking b ON i.booking_id = b.id
JOIN unit_mobil u ON b.unit_mobil_id = u.id
WHERE i.id = $id");

$data = mysqli_fetch_assoc($query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $booking_id = $_POST['booking_id'];
    $kondisi = $_POST['kondisi'];
    $catatan = $_POST['catatan'];
    $denda = $_POST['denda'];

    // Query update ke database
    $update_query = "UPDATE inspeksi SET booking_id='$booking_id', kondisi_pre='$kondisi', catatan='$catatan', denda='$denda' WHERE id=$id";

    if (mysqli_query($db, $update_query)) {
        echo "Data berhasil diupdate!";
        header("Location: riwayat.php");
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($db);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Riwayat Pemeriksaan</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body>
  <div class="container">
    <h3>Edit Riwayat Pemeriksaan</h3>

    <form action="" method="POST">
      <div class="mb-3">
        <label>ID Booking:</label>
        <input type="text" name="booking_id" class="form-control" value="<?= $data['booking_id'] ?>" required>
      </div>

      <div class="mb-3">
        <label>Kondisi Awal:</label>
        <input type="text" name="kondisi" class="form-control" value="<?= $data['kondisi_pre'] ?>" required>
      </div>

      <div class="mb-3">
        <label>Catatan:</label>
        <textarea name="catatan" class="form-control"><?= $data['catatan'] ?></textarea>
      </div>

      <div class="mb-3">
        <label>Denda (Rp):</label>
        <input type="number" name="denda" class="form-control" value="<?= $data['denda'] ?>" required>
      </div>

      <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
  </div>
</body>
</html>
