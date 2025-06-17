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
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            justify-content: center;
        }

        .custom-card {
            /* background-color: #0f172a; */
            color: black;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
            border: 1px solid #1e293b;
            width: 320px;
        }

        .custom-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            /* background-color: #1e293b; */
        }

        .custom-card .card-body {
            padding: 20px;
        }

        .custom-card .card-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .custom-card .card-row {
            display: flex;
            align-items: center;
            font-size: 14px;
            margin-bottom: 8px;
            gap: 24px;
        }

        .custom-card .card-row span {
            display: flex;
            align-items: center;
        }

        .custom-card .card-row i {
            margin-right: 6px;
            min-width: 16px;
            text-align: center;
        }

        .status-label {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 15px;
            background-color: #10b981;
            color: white;
        }

        .status-disewa {
            background-color: #f59e0b;
        }

        .status-perbaikan {
            background-color: #ef4444;
        }

        .custom-card .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .custom-card .btn-action {
            flex: 1;
            margin: 0 4px;
            text-align: center;
            background-color: #334155;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 10px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .custom-card .btn-action:hover {
            background-color: #1e293b;
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
                            $statusClass = match ($row['status']) {
                                'disewa' => 'status-label status-disewa',
                                'perbaikan' => 'status-label status-perbaikan',
                                default => 'status-label'
                            };
                        ?>
                            <div class="custom-card">
                                <img src="../../../uploads/foto-mobil/<?= $row['foto'] ?>" alt="Foto mobil <?= htmlspecialchars($row['nama_mobil']) ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($row['nama_mobil']) ?></h5>
                                    <span class="<?= $statusClass ?>">
                                        <?= $row['status'] === 'tersedia' ? 'Ready' : ($row['status'] === 'disewa' ? 'Disewa' : 'Perbaikan') ?>
                                    </span>
                                    <div class="card-row">
                                        <span><i class="fas fa-money-bill-wave"></i> Rp<?= number_format($row['harga_sewa']) ?></span>
                                        <span><i class="fas fa-cogs"></i> <?= htmlspecialchars($row['transmisi']) ?></span>
                                    </div>
                                    <div class="card-row">
                                        <span><i class="fas fa-users"></i> <?= $row['jumlah_kursi'] ?> Kursi</span>
                                        <span><i class="fas fa-car"></i> <?= htmlspecialchars($row['plat_nomor']) ?></span>
                                    </div>
                                    <div class="card-row">
                                        <span><i class="fas fa-palette"></i> <?= htmlspecialchars($row['warna']) ?></span>
                                    </div>
                                    <div class="action-buttons">
                                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn-action"><i class="fas fa-edit"></i> Edit</a>
                                        <form action="actions.php" method="post" style="display:inline;">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <button type="submit" name="delete" class="btn-action" onclick="return confirm('Hapus unit mobil ini?')">
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