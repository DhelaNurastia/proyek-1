<?php
require_once '../../koneksi.php';
$tipe = $_GET['tipe'] ?? '';

if ($tipe === 'mingguan') {
    $result = mysqli_query($db, "
        SELECT DATE_FORMAT(tgl_booking, '%a') AS hari, COUNT(*) as jumlah
        FROM booking
        WHERE YEARWEEK(tgl_booking, 1) = YEARWEEK(CURDATE(), 1)
        GROUP BY hari
    ");

    $labels = [];
    $values = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $labels[] = $row['hari'];
        $values[] = $row['jumlah'];
    }

    echo json_encode(['labels' => $labels, 'values' => $values]);
} elseif ($tipe === 'harian') {
    $hariIni = date('Y-m-d');
    $booking = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS total FROM booking WHERE tgl_booking = '$hariIni'"))['total'];
    $kembali = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS total FROM booking WHERE tgl_kembali = '$hariIni'"))['total'];
    $masuk = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS total FROM booking WHERE status = 'Masuk' AND tgl_booking = '$hariIni'"))['total'];

    echo json_encode([
        'labels' => ['Booking Hari Ini', 'Pengembalian Hari Ini', 'Booking Masuk'],
        'values' => [$booking, $kembali, $masuk]
    ]);
}
