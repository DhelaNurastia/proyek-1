<?php
require_once "../../../config.php";
require_once "../../../koneksi.php";
require_once "../../../functions.php";

$sql = "SELECT c.nama AS nama_customer, j.nama AS nama_unit, b.tgl_booking, b.tgl_kembali, b.status, p.status AS status_pembayaran
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
    <meta charset="utf-8">
    <title><?= APP_NAME ?> - Verifikasi Pengguna</title>
    <link href="../../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../../../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include '../../../components/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include '../../../components/topbar.php'; ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Verifikasi Customer</h1>
                    <p class="mb-4">Berikut adalah daftar customer yang menunggu verifikasi dokumen.</p>

                    <div class="card shadow mb-4">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Custommer</th>
                                        <th>Mobil</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status Booking</th>
                                        <th>Status Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result as $index => $row) : ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= htmlspecialchars($row[0]) ?></td>
                                            <td><?= htmlspecialchars($row[1]) ?></td>
                                            <td><?= formatTanggal(htmlspecialchars($row[2])) ?></td>
                                            <td><?= formatTanggal(htmlspecialchars($row[3])) ?></td>
                                            <td><?= kapital(htmlspecialchars($row[4])) ?></td>
                                            <td><?= kapital(htmlspecialchars($row[5])) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php include '../../../components/footer.php'; ?>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
    <?php include '../../../components/logout-modal.php'; ?>

    <!-- Modal untuk menampilkan gambar -->
    <div class="modal fade" id="modalGambar" tabindex="-1" role="dialog" aria-labelledby="modalGambarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalGambarLabel">Gambar Dokumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="gambarDokumen" src="" alt="Dokumen" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <script src="../../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/js/sb-admin-2.min.js"></script>
    <script src="../../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../../../assets/js/demo/datatables-demo.js"></script>
</body>

</html>