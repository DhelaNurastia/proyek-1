<?php
require_once "../../../config.php";
require '../../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);

    if (empty($nama)) {
        echo '<script>alert("isi semua data!")</script>';
    } else {
        $sql = 'INSERT INTO fasilitas (nama) VALUES (?)';
        $stmt = $db->prepare($sql);
        $stmt->execute([$nama]);
        $stmt->close();

        header('location: ./index.php');
        exit();
    }
}
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
                    <h1 class="h3 mb-2 text-gray-800">Buat fasilitas baru</h1>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel ipsam aspernatur voluptates consectetur labore doloribus placeat!</p>

                    <!-- Konten Utama -->
                    <form method="post" class="d-flex flex-column">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" autofocus class="form-control" id="nama" name="nama" placeholder="Contoh: supir, lepas kunci, dll...">
                        </div>
                        <div class="d-flex align-items-center justify-content-end">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-plus"></i> Tambah</button>
                            <a href="./index.php" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer -->
            <?php include '../../../components/footer.php'; ?>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include '../../../components/logout-modal.php'; ?>

    <script src="../../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../../../assets/js/sb-admin-2.min.js"></script>
    <script src="../../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../../../assets/js/demo/datatables-demo.js"></script>
</body>

</html>