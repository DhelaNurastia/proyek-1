<?php
require_once "../../../config.php";
require_once "../../../koneksi.php";

// Ambil data jenis mobil untuk dropdown
$jenis_mobil = mysqli_query($db, "SELECT id, nama FROM jenis_mobil ORDER BY nama ASC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= APP_NAME ?></title>
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
                    <h1 class="h3 mb-2 text-gray-800">Tambah Unit Mobil</h1>
                    <p class="mb-4">Lengkapi form berikut untuk menambahkan unit mobil baru ke sistem.</p>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form method="post" action="actions.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="jenis_mobil_id">Jenis Mobil</label>
                                    <select name="jenis_mobil_id" id="jenis_mobil_id" class="form-control" required>
                                        <option value="">-- Pilih Jenis Mobil --</option>
                                        <?php while ($row = mysqli_fetch_assoc($jenis_mobil)) : ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="foto">Foto Mobil</label>
                                    <input type="file" name="foto" id="foto" class="form-control-file" accept="image/*" required>
                                </div>

                                <div class="form-group">
                                    <label for="plat_nomor">Plat Nomor</label>
                                    <input type="text" name="plat_nomor" id="plat_nomor" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="warna">Warna</label>
                                    <input type="text" name="warna" id="warna" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="tahun_beli">Tahun Beli</label>
                                    <input type="number" name="tahun_beli" id="tahun_beli" class="form-control" min="2000" max="<?= date('Y') ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="tersedia">Tersedia</option>
                                        <option value="disewa">Disewa</option>
                                        <option value="perbaikan">Perbaikan</option>
                                    </select>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" name="create" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                    <a href="index.php" class="btn btn-secondary ml-2">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <?php include '../../../components/footer.php'; ?>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
    <?php include '../../../components/logout-modal.php'; ?>

    <script src="../../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/js/sb-admin-2.min.js"></script>
</body>

</html>