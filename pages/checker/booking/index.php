<?php
require_once "../../../koneksi.php";
require_once "../../../functions.php";

$sql = "SELECT b.id, c.nama AS nama_customer, j.nama AS nama_unit, b.tgl_booking, b.tgl_kembali, b.status, p.status AS status_pembayaran
        FROM booking AS b
        JOIN pembayaran AS p ON p.booking_id = b.id
        JOIN users AS c ON c.id = b.customer_id
        JOIN unit_mobil AS u ON u.id = b.unit_mobil_id
        JOIN jenis_mobil AS j ON j.id = u.jenis_mobil_id;";

$result = mysqli_query($db, $sql)->fetch_all();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Booking</title>
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Mobil</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status Booking</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $index => $booking): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $booking[1] ?></td>
                    <td><?= $booking[2] ?></td>
                    <td><?= formatTanggal($booking[3]) ?></td>
                    <td><?= formatTanggal($booking[4]) ?></td>
                    <td><?= kapital($booking[5]) ?></td>
                    <td><?= kapital($booking[6]) ?></td>
                    <td><a href="create.php?booking_id=<?= $booking[0] ?>">Cek</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>