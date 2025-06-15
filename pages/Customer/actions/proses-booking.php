<?php

require_once '../../../vendor/autoload.php';
require_once '../../../koneksi.php';

header('Content-Type: application/json');

// Ambil data JSON dari fetch
$data = json_decode(file_get_contents("php://input"), true);
$data['status'] = 'pending';

// Pastikas data booking tidak kosong
foreach ($data as $d):
    if (empty($d)):
        echo json_encode([
            "message" => "Data booking tidak valid"
        ]);
        exit;
    endif;
endforeach;

// Konfigurasi Midtrans
\Midtrans\Config::$serverKey = 'SB-Mid-server-uH10eM8NFBYrFd86DHH2kFOw';
\Midtrans\Config::$isProduction = false; // Sandbox dulu
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Ambil data customer
$stmt = mysqli_prepare($db, "SELECT nama, telepon, email, status_verifikasi FROM users WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $data['customer_id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$customer = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// Hanya pengguna terverifikasi yang dapat melakukan booking
if ($customer['status_verifikasi'] == 'belum diverifikasi') {
    echo json_encode([
        "message" => "Akun Anda belum diverifikasi oleh admin."
    ]);
    exit;
}

// Membuat data booking
$stmt = mysqli_prepare($db, "INSERT INTO booking (unit_mobil_id, customer_id, metode_pembayaran, total_biaya, jaminan, tgl_booking, durasi, tgl_kembali, status, fasilitas, jam_booking, jam_kembali) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
mysqli_stmt_bind_param($stmt, "iisississsss", $data['unit_mobil_id'], $data['customer_id'], $data['metode_pembayaran'], $data['total_biaya'], $data['jaminan'], $data['tgl_booking'], $data['durasi'], $data['tgl_kembali'], $data['status'], $data['fasilitas'], $data['jam_booking'], $data['jam_kembali']);
mysqli_stmt_execute($stmt);
$bookingId = mysqli_stmt_insert_id($stmt);
mysqli_stmt_close($stmt);

// Membuat order_id
$orderId = 'booking-' . rand();

// Membuat data pembayaran
$stmt = mysqli_prepare($db, "INSERT INTO pembayaran (booking_id, jumlah, status, order_id) VALUES (?, ?, ?, ?);");
mysqli_stmt_bind_param($stmt, "iiss", $bookingId, $data['total_biaya'], $data['status'], $orderId);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($db);

// Membuat data transaksi
$params = [
    'transaction_details' => [
        'order_id' => $orderId,
        'gross_amount' => $data['total_biaya'],
    ],
    'customer_details' => [
        'first_name' => $customer['nama'],
        'last_name' => '',
        'email' => $customer['email'],
        'phone' => $customer['telepon'],
    ],
];

// Generate token Snap
$snapToken = \Midtrans\Snap::getSnapToken($params);
echo json_encode([
    'snapToken' => $snapToken,
]);
