<?php
require_once "../../../config.php";
require_once "../../../koneksi.php";

// Ambil user customer yang belum diverifikasi
$sql = "
    SELECT u.*, d.file_ktp, d.file_sim, d.file_kk
    FROM users u
    JOIN dokumen_user d ON u.id = d.id_user
    WHERE u.role = 'customer' AND u.status_verifikasi = 'belum diverifikasi'
";
$result = mysqli_query($db, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= APP_NAME ?> - Verifikasi Pengguna</title>
    <link href="../../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../../../assets/css/sb-admin-2.min.css" rel="stylesheet">
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
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>KTP</th>
                                        <th>SIM</th>
                                        <th>KK</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['nama']) ?></td>
                                            <td><?= htmlspecialchars($row['email']) ?></td>
                                            <td><?= htmlspecialchars($row['telepon']) ?></td>
                                            <td>
                                                <?php if ($row['file_ktp']): ?>
                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalGambar" data-gambar="/proyek-1/uploads/dokumen-user/<?= $row['file_ktp'] ?>">Lihat</button>
                                                <?php else: ?>
                                                    <em class="text-muted">Belum ada</em>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($row['file_sim']): ?>
                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalGambar" data-gambar="/proyek-1/uploads/dokumen-user/<?= $row['file_sim'] ?>">Lihat</button>
                                                <?php else: ?>
                                                    <em class="text-muted">Belum ada</em>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($row['file_kk']): ?>
                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalGambar" data-gambar="/proyek-1/uploads/dokumen-user/<?= $row['file_kk'] ?>">Lihat</button>
                                                <?php else: ?>
                                                    <em class="text-muted">Belum ada</em>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <form action="actions.php" method="post">
                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                    <button name="verifikasi" class="btn btn-success btn-sm" onclick="return confirm('Verifikasi user ini?')">
                                                        <i class="fas fa-check"></i> Verifikasi
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
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
    <script>
        // Script untuk mengatur gambar modal
        $('#modalGambar').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var gambar = button.data('gambar'); // Ambil data gambar dari tombol
            var modal = $(this);
            modal.find('#gambarDokumen').attr('src', gambar); // Set src gambar
        });
    </script>
</body>

</html>