<?php
require_once "../../../config.php";
require_once "../../../koneksi.php";

// Validasi ID
$id = $_GET["id"] ?? null;
if (!$id) {
    header("Location: index.php?error=ID tidak ditemukan");
    exit;
}

// Ambil data unit mobil
$query = "SELECT unit_mobil.*, jenis_mobil.nama AS nama_jenis FROM unit_mobil 
          JOIN jenis_mobil ON unit_mobil.jenis_mobil_id = jenis_mobil.id 
          WHERE unit_mobil.id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$unit = $result->fetch_assoc();

if (!$unit) {
    header("Location: index.php?error=Data tidak ditemukan");
    exit;
}

// Ambil semua jenis mobil untuk dropdown
$jenisMobil = $db->query("SELECT * FROM jenis_mobil")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= APP_NAME ?> - Edit Unit Mobil</title>
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
                    <h1 class="h3 mb-4 text-gray-800">Edit Unit Mobil</h1>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="actions.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $unit["id"] ?>">

                                <!-- Jenis Mobil -->
                                <div class="form-group">
                                    <label for="jenis_mobil_id">Jenis Mobil</label>
                                    <select name="jenis_mobil_id" id="jenis_mobil_id" class="form-control" required>
                                        <?php foreach ($jenisMobil as $jm): ?>
                                            <option value="<?= $jm['id'] ?>" <?= $jm['id'] == $unit['jenis_mobil_id'] ? 'selected' : '' ?>>
                                                <?= $jm['nama'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Foto -->
                                <div class="form-group">
                                    <label for="foto">Ganti Foto (kosongkan jika tidak diganti)</label>
                                    <input type="file" name="foto" id="foto" class="form-control-file">
                                    <?php if (!empty($unit['foto'])): ?>
                                        <p class="mt-2"><img src="../../../uploads/dokumen-user/foto-mobil/<?= $unit['foto'] ?>" width="120" alt="Foto Mobil" class="img-thumbnail"></p>
                                    <?php endif; ?>
                                </div>

                                <!-- Plat Nomor -->
                                <div class="form-group">
                                    <label for="plat_nomor">Plat Nomor</label>
                                    <input type="text" name="plat_nomor" id="plat_nomor" class="form-control" value="<?= $unit['plat_nomor'] ?>" required>
                                </div>

                                <!-- Warna -->
                                <div class="form-group">
                                    <label for="warna">Warna</label>
                                    <input type="text" name="warna" id="warna" class="form-control" value="<?= $unit['warna'] ?>" required>
                                </div>

                                <!-- Tahun Beli -->
                                <div class="form-group">
                                    <label for="tahun_beli">Tahun Beli</label>
                                    <input type="number" name="tahun_beli" id="tahun_beli" class="form-control" min="2000" max="<?= date('Y') ?>" value="<?= $unit['tahun_beli'] ?>" required>
                                </div>

                                <!-- Transmisi -->
                                <div class="form-group">
                                    <label for="transmisi">Transmisi</label>
                                    <select name="transmisi" id="transmisi" class="form-control" required>
                                        <option value="Manual" <?= $unit['transmisi'] === 'Manual' ? 'selected' : '' ?>>Manual</option>
                                        <option value="Matic" <?= $unit['transmisi'] === 'Matic' ? 'selected' : '' ?>>Matic</option>
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="tersedia" <?= $unit['status'] === 'tersedia' ? 'selected' : '' ?>>Tersedia</option>
                                        <option value="disewa" <?= $unit['status'] === 'disewa' ? 'selected' : '' ?>>Disewa</option>
                                        <option value="perbaikan" <?= $unit['status'] === 'perbaikan' ? 'selected' : '' ?>>Perbaikan</option>
                                    </select>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="d-flex justify-content-end">
                                    <button type="submit" name="update" class="btn btn-primary mr-2">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <a href="index.php" class="btn btn-secondary">Kembali</a>
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