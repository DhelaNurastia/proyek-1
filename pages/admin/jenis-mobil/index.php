<?php
require_once "../../../config.php";
require_once "../../../koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo APP_NAME; ?></title>
    <!-- Styles -->
    <link href="../../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Njeniso:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../../../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        .table {
            background-color: rgb(255, 255, 255);
            color: #111827;
        }

        .table th .table td {
            border-color: #111827;
        }

        .btn-primary {
            background-color: #1e293b;
            /* biru navy misalnya */
            border-color: #1e293b;
        }

        .btn-primary:hover {
            background-color: #1c3faa;
            border-color: #1a3aa1;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include '../../../components/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                <?php include '../../../components/topbar.php'; ?>
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Jenis Mobil</h1>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel ipsam aspernatur voluptates consectetur labore doloribus placeat!</p>
                    <!-- Konten Utama -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Jenis Mobil</h6>
                            <a href="./create.php" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Jenis Mobil Baru</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Harga Sewa</th>
                                            <th>Jumlah Kursi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Harga Sewa</th>
                                            <th>Jumlah Kursi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach (mysqli_query($db, "SELECT * FROM jenis_mobil ORDER BY id DESC")->fetch_all() as $index => $jenis_mobil): ?>
                                            <tr>
                                                <td><?php echo $index + 1; ?></td>
                                                <td><?php echo $jenis_mobil[1]; ?></td>
                                                <td>Rp <?php echo number_format($jenis_mobil[2]); ?></td>
                                                <td><?php echo $jenis_mobil[3]; ?></td>
                                                <td>
                                                    <form action="./actions.php" method="post">
                                                        <input type="hidden" name="id" value="<?php echo $jenis_mobil[0]; ?>">
                                                        <a href="edit.php?id=<?php echo $jenis_mobil[0]; ?>" class="mr-2 btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                                                        <button onclick="return confirm('Hapus jenis mobil?');" type="submit" name="delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <?php include '../../../components/footer.php'; ?>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
    <!-- Logout modal -->
    <?php include_once '../../../components/logout-modal.php'; ?>
    <!-- Scripts -->
    <script src="../../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../../../assets/js/sb-admin-2.min.js"></script>
    <script src="../../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../../../assets/js/demo/datatables-demo.js"></script>
</body>

</html>