<?php
session_start();
require_once "../../koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../Halaman_Register&Login/login.php");
    exit;
}

$id_booking = $_GET['id'] ?? 0;
$id_customer = $_SESSION['user_id'];

// Cek apakah booking ini masih pending dan milik customer
$cek = $db->prepare("SELECT * FROM booking WHERE id = ? AND customer_id = ? AND status = 'pending'");
$cek->bind_param("ii", $id_booking, $id_customer);
$cek->execute();
$result = $cek->get_result();

if ($result->num_rows > 0) {
    // Update status jadi cancelled
    $update = $db->prepare("UPDATE booking SET status = 'cancelled' WHERE id = ?");
    $update->bind_param("i", $id_booking);
    $update->execute();
}

// Kembali ke halaman riwayat
header("Location: riwayat.php");
exit;
