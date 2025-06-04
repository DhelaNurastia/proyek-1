<?php
require_once "../../../config.php";
require_once "../../../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= APP_NAME; ?></title>
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
                    <h1 class="h3 mb-2 text-gray-800">Data Unit Mobil</h1>
                    <p class="mb-4">Berikut adalah daftar unit mobil yang tersedia di sistem.</p>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Unit Mobil</h6>
                            <a href="./create.php" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Unit Mobil</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama Mobil</th>
                                            <th>Plat Nomor</th>
                                            <th>Warna</th>
                                            <th>Tahun Beli</th>
                                            <th>Transmisi</th>
                                            <th>Harga Sewa</th>
                                            <th>Jumlah Kursi</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "
                                        SELECT 
                                            u.id, j.nama AS nama_mobil, u.plat_nomor, u.warna, u.tahun_beli,
                                            u.transmisi, j.harga_sewa, j.jumlah_kursi, u.status, u.foto
                                        FROM unit_mobil u
                                        JOIN jenis_mobil j ON u.jenis_mobil_id = j.id
                                        ORDER BY u.id DESC
                                    ";
                                        $result = mysqli_query($db, $query);
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($result)) :
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td>
                                                    <?php if (!empty($row['foto'])) : ?>
                                                        <img src="./uploads/<?= $row['foto'] ?>" alt="Foto Mobil" width="100" class="img-thumbnail">
                                                    <?php else : ?>
                                                        <em class="text-muted">Tidak ada foto</em>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= htmlspecialchars($row['nama_mobil']) ?></td>
                                                <td><?= htmlspecialchars($row['plat_nomor']) ?></td>
                                                <td><?= htmlspecialchars($row['warna']) ?></td>
                                                <td><?= htmlspecialchars($row['tahun_beli']) ?></td>
                                                <td><?= htmlspecialchars($row['transmisi']) ?></td>
                                                <td>Rp <?= number_format($row['harga_sewa']) ?></td>
                                                <td><?= $row['jumlah_kursi'] ?> Kursi</td>
                                                <td><span class="badge badge-info"><?= ucfirst($row['status']) ?></span></td>
                                                <td>
                                                    <form action="./actions.php" method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                                                        <button type="submit" name="delete" class="btn btn-sm btn-danger" onclick="return confirm('Hapus unit mobil ini?')">
                                                            <i class="fas fa-trash"></i>
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
            </div>
            <?php include '../../../components/footer.php'; ?>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
    <?php include '../../../components/logout-modal.php'; ?>

    <script src="../../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../../../assets/js/sb-admin-2.min.js"></script>
    <script src="../../../assets/js/demo/datatables-demo.js"></script>
</body>

</html>