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
    <style>
        .card {
            border-radius: 15px;
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 20px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            height: 200px;
            object-fit: cover;
        }

        .badge {
            font-size: 0.9rem;
        }
    </style>
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

                    <div class="row">
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
                        while ($row = mysqli_fetch_assoc($result)) :
                        ?>
                            <div class="col-md-4">
                                <div class="card shadow">
                                    <img src="./uploads/<?= $row['foto'] ?>" alt="Foto Mobil" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($row['nama_mobil']) ?></h5>
                                        <p class="card-text">
                                            <strong>Plat Nomor:</strong> <?= htmlspecialchars($row['plat_nomor']) ?><br>
                                            <strong>Warna:</strong> <?= htmlspecialchars($row['warna']) ?><br>
                                            <strong>Tahun Beli:</strong> <?= htmlspecialchars($row['tahun_beli']) ?><br>
                                            <strong>Transmisi:</strong> <?= htmlspecialchars($row['transmisi']) ?><br>
                                            <strong>Harga Sewa:</strong> Rp <?= number_format($row['harga_sewa']) ?><br>
                                            <strong>Jumlah Kursi:</strong> <?= $row['jumlah_kursi'] ?> Kursi<br>
                                            <span class="badge badge-info"><?= ucfirst($row['status']) ?></span>
                                        </p>
                                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-secondary"><i class="fas fa-edit"></i> Edit</a>
                                        <form action="./actions.php" method="post" style="display:inline;">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Hapus unit mobil ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
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