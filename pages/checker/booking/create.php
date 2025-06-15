<?php
require_once "../../../koneksi.php";
require_once "../../../functions.php";

session_start();

$bookingId = $_GET["booking_id"] ?? null;
$userId = $_SESSION["user_id"];

if (empty($bookingId)) {
    header("location: index.php?message='id booking tidak valid'");
    exit;
}

$sql = "SELECT b.id, c.nama AS nama_customer, j.nama AS nama_unit, b.tgl_booking, b.tgl_kembali, b.status, p.status AS status_pembayaran
        FROM booking AS b
        JOIN pembayaran AS p ON p.booking_id = b.id
        JOIN users AS c ON c.id = b.customer_id
        JOIN unit_mobil AS u ON u.id = b.unit_mobil_id
        JOIN jenis_mobil AS j ON j.id = u.jenis_mobil_id
        WHERE b.id = ?;";

$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, "i", $bookingId);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$booking = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);
mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat laporan pengecekan</title>
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Mobil</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status Booking</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $booking["nama_customer"] ?></td>
                <td><?= $booking["nama_unit"] ?></td>
                <td><?= formatTanggal($booking["tgl_booking"]) ?></td>
                <td><?= formatTanggal($booking["tgl_kembali"]) ?></td>
                <td><?= kapital($booking["status"]) ?></td>
                <td><?= kapital($booking["status_pembayaran"]) ?></td>
            </tr>
        </tbody>
    </table>
    <form action="actions.php" method="post">
        <input type="hidden" name="bookingId" value="<?= $bookingId ?>">
        <input type="hidden" name="userId" value="<?= $userId ?>">

        <select name="tipe">
            <option value="pre">Pre</option>
            <option value="post">Post</option>
        </select>
        <select name="kondisi">
            <option value="normal">Normal</option>
            <option value="rusak">Rusak</option>
        </select>
        <textarea name="catatan"></textarea>
        <input type="file" name="foto">
        <button type="submit" name="">Buat Laporan</button>
    </form>
</body>

</html>