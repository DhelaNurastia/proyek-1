<?php
require_once "../../../config.php";
require_once "../../../koneksi.php";

// Ambil input dari parameter
$id = $_GET["id"];

// Query ke database
$stmt = mysqli_prepare($db, "SELECT * FROM users WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$marketing = mysqli_stmt_get_result($stmt)->fetch_assoc();
mysqli_stmt_close($stmt);
mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= APP_NAME; ?></title>
    <!-- Styles -->
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
                    <h1 class="h3 mb-2 text-gray-800">Edit Marketing</h1>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel ipsam aspernatur
                        voluptates consectetur labore doloribus placeat!</p>
                    <!-- Konten Utama -->
                    <div class="card shadow">
                        <div class="card-body">
                            <form action="./actions.php" method="post" class="d-flex flex-column">
                                <input type="hidden" name="id" value="<?= $marketing["id"]; ?>">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control"
                                        value="<?= $marketing["nama"]; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="telepon" class="form-label">Telepon</label>
                                    <input type="tel" name="telepon" id="telepon" class="form-control"
                                        value="<?= $marketing["telepon"]; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="<?= $marketing["email"]; ?>">
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                    <button type="submit" name="update" class="btn btn-primary mr-2"><i
                                            class="fas fa-save"></i>Simpan</button>
                                    <a href="./index.php" class="btn btn-secondary">Kembali</a>
                                </div>
                            </form>
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