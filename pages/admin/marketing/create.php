<?php
require_once "../../../config.php";
require '../../../koneksi.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo APP_NAME; ?></title>

    <link href="../../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="../../../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                    <h1 class="h3 mb-2 text-gray-800">Tambah Marketing Baru</h1>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel ipsam aspernatur voluptates consectetur labore doloribus placeat!</p>



                    <!-- ========== Konten Utama ========== -->
                    <form action="./action.php" method="post" class="d-flex flex-column" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="tel" name="telepon" id="telepon" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="d-flex align-items-center justify-content-end">
                            <button name="create" type="submit" class="btn btn-primary mr-2"><i class="fas fa-save"></i> Simpan</button>
                            <a href="./index.php" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                    <!-- ========== Konten Utama ========== -->



                </div>
            </div>
            <!-- Footer -->
            <?php include '../../../components/footer.php'; ?>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout modal -->
    <?php include '../../../components/logout-modal.php'; ?>

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