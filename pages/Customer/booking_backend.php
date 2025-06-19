<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

include '../../koneksi.php'; // pastikan koneksi database ada di file ini

// Fetch user data
if (isset($_GET['id_user'])) {
  $id = $_GET['id_user'];
  $stmt = $conn->prepare("SELECT * FROM user WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result()->fetch_assoc();
  echo json_encode($result);
  exit();
}

// Fetch mobil data
if (isset($_GET['unit_mobil_id'])) {
  $id = $_GET['unit_mobil_id'];
  $stmt = $db->prepare("SELECT * FROM unit_mobil WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result()->fetch_assoc();
  echo json_encode($result);
  exit();
}

// Proses Booking
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $_SESSION['user_id'];
  $unit_mobil_id = $_POST['unit_mobil_id'];
  $tanggal_pengambilan = $_POST['tanggal_pengambilan'];
  $jam_pengambilan = $_POST['jam_pengambilan'];
  $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
  $jam_pengembalian = $_POST['jam_pengembalian'];
  $fasilitas = $_POST['fasilitas'];
  $jaminan = $_POST['jaminan'];
  $metode_pembayaran = $_POST['metode_pembayaran'];

  // Simpan ke database booking
  $stmt = $conn->prepare("INSERT INTO booking (user_id, unit_mobil_id, tanggal_pengambilan, jam_pengambilan, tanggal_pengembalian, jam_pengembalian, fasilitas, jaminan, metode_pembayaran) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("iisssssss", $user_id, $unit_mobil_id, $tanggal_pengambilan, $jam_pengambilan, $tanggal_pengembalian, $jam_pengembalian, $fasilitas, $jaminan, $metode_pembayaran);

  if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Booking berhasil']);
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal melakukan booking']);
  }

  exit();
}

session_start();
$id_user = $_SESSION['user_id'];

$cek = mysqli_query($db, "SELECT status_verifikasi FROM users WHERE id = '$id_user'");
$data = mysqli_fetch_assoc($cek);

if ($data['status_verifikasi'] === 'ditolak') {
  echo "<script>alert('Akun Anda telah ditolak dan tidak dapat melakukan booking.'); window.location.href='listing.php';</script>";
  exit;
}