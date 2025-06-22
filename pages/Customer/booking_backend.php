<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

include '../../koneksi.php'; // pastikan koneksi database ada di file ini

function submitBooking($nama, $email, $telepon, $tanggal, $waktu, $pesan)
{
  $host = 'localhost';
  $dbname = 'your_database';
  $username = 'your_username';
  $password = 'your_password';

  try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 🔍 CEK APAKAH SUDAH ADA BOOKING DENGAN EMAIL & TANGGAL + WAKTU YANG SAMA
    $checkSql = "SELECT COUNT(*) FROM bookings WHERE email = :email AND tanggal = :tanggal AND waktu = :waktu";
    $stmtCheck = $pdo->prepare($checkSql);
    $stmtCheck->execute([
      ':email' => $email,
      ':tanggal' => $tanggal,
      ':waktu' => $waktu
    ]);
    $count = $stmtCheck->fetchColumn();

    if ($count > 0) {
      // 🚫 Booking duplikat ditemukan
      return "Booking gagal: Anda sudah melakukan booking pada tanggal dan waktu tersebut.";
    }

    // ✅ Tidak duplikat, lanjut simpan
    $sql = "INSERT INTO bookings (nama, email, telepon, tanggal, waktu, pesan) 
              VALUES (:nama, :email, :telepon, :tanggal, :waktu, :pesan)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':nama' => $nama,
      ':email' => $email,
      ':telepon' => $telepon,
      ':tanggal' => $tanggal,
      ':waktu' => $waktu,
      ':pesan' => $pesan
    ]);

    return "Booking berhasil disimpan!";
  } catch (PDOException $e) {
    return "Error: " . $e->getMessage();
  }
}
