<?php
session_start();
include '../../koneksi.php';

$base_url = '/proyek-1/';
$id_customer = $_SESSION['user_id'];

// Ambil data denda berdasarkan booking customer
$query = "
    SELECT 
        i.id AS inspeksi_id,
        b.id AS booking_id,
        jm.nama AS nama_mobil,
        u.plat_nomor,
        b.tgl_kembali,
        i.kondisi_post,
        i.catatan,
        i.denda,
        i.foto_post
    FROM inspeksi i
    JOIN booking b ON i.booking_id = b.id
    JOIN unit_mobil u ON b.unit_mobil_id = u.id
    JOIN jenis_mobil jm ON u.jenis_mobil_id = jm.id
    WHERE b.customer_id = $id_customer
      AND i.denda > 0
    ORDER BY b.tgl_kembali DESC
";
$result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Riwayat Denda</title>
    <link rel="stylesheet" href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/bootstrap/css/bootstrap.min.css" />
    <style>
        body {
            padding: 2rem;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        h2 {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        th,
        td {
            padding: 12px 16px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #343a40;
            color: #fff;
        }

        img {
            max-width: 120px;
            border-radius: 6px;
        }
    </style>
</head>

<body>
    <h2>Riwayat Denda Anda</h2>

    <table>
        <thead>
            <tr>
                <th>ID Booking</th>
                <th>Plat Nomor</th>
                <th>Tanggal Kembali</th>
                <th>Kondisi Akhir</th>
                <th>Catatan</th>
                <th>Foto Bukti</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>#BK<?= str_pad($row['booking_id'], 8, '0', STR_PAD_LEFT) ?></td>
                        <td><?= htmlspecialchars($row['plat_nomor']) ?></td>
                        <td><?= date('d-m-Y', strtotime($row['tgl_kembali'])) ?></td>
                        <td><?= ucfirst($row['kondisi_post']) ?></td>
                        <td><?= nl2br(htmlspecialchars($row['catatan'])) ?></td>
                        <td>
                            <?php if (!empty($row['foto_post'])): ?>
                                <img src="<?= $base_url ?>uploads/foto_pre_post/<?= $row['foto_post'] ?>" alt="Bukti Foto">
                            <?php else: ?>
                                <em>Tidak ada foto</em>
                            <?php endif; ?>
                        </td>
                        <td>Rp <?= number_format($row['denda'], 0, ',', '.') ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align:center;">Tidak ada riwayat denda ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</body>

</html>